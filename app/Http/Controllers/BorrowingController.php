<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingController extends Controller
{
    // Menampilkan riwayat peminjaman
    public function index()
    {
        $query = Borrowing::with(['user', 'equipment.category']);

        // Admin melihat semua data, athlete hanya data sendiri
        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $borrowings = $query->latest()->get();

        return view('borrowings.index', compact('borrowings'));
    }

    // Menampilkan form peminjaman
    public function create()
    {
        $equipment = Equipment::with('category')
            ->where('quantity', '>', 0)
            ->orderBy('name')
            ->get();

        return view('borrowings.create', compact('equipment'));
    }

    // Menyimpan peminjaman dan mengurangi stok
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'quantity' => 'required|integer|min:1',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        DB::transaction(function () use ($validated) {
            $equipment = Equipment::whereKey($validated['equipment_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($validated['quantity'] > $equipment->quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'The requested quantity exceeds available stock.',
                ]);
            }

            $equipment->decrement('quantity', $validated['quantity']);

            Borrowing::create([
                'user_id' => auth()->id(),
                'equipment_id' => $equipment->id,
                'quantity' => $validated['quantity'],
                'borrowed_at' => now()->toDateString(),
                'due_date' => $validated['due_date'] ?? null,
                'status' => 'Borrowed',
            ]);
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Equipment borrowed successfully.');
    }

    // Menampilkan detail peminjaman dengan pengecekan hak akses
    public function show(Borrowing $borrowing)
    {
        // Athlete tidak boleh melihat data user lain
        if (
            ! auth()->user()->isAdmin()
            && $borrowing->user_id !== auth()->id()
        ) {
            abort(403, 'You are not authorized to view this borrowing.');
        }

        $borrowing->load(['user', 'equipment.category']);

        return view('borrowings.show', compact('borrowing'));
    }

    // Mengarahkan halaman edit ke detail
    public function edit(Borrowing $borrowing)
    {
        return redirect()->route('borrowings.show', $borrowing);
    }

    // Athlete mengajukan pengembalian, admin menyelesaikan pengembalian
    public function update(Request $request, Borrowing $borrowing)
    {
        $user = auth()->user();

        // Proses pengajuan pengembalian oleh athlete
        if (! $user->isAdmin()) {
            // Athlete hanya boleh mengajukan pengembalian miliknya sendiri
            if ((int) $borrowing->user_id !== (int) $user->id) {
                abort(403, 'You are not authorized to return this borrowing.');
            }

            // Pastikan peminjaman masih berstatus Borrowed
            if ($borrowing->status !== 'Borrowed') {
                return redirect()
                    ->route('borrowings.index')
                    ->with('error', 'This borrowing cannot be returned again.');
            }

            $borrowing->update([
                'status' => 'Pending Approval',
            ]);

            // Stok belum ditambah karena menunggu pemeriksaan admin
            return redirect()
                ->route('borrowings.index')
                ->with(
                    'success',
                    'Return request submitted successfully. Please hand over the equipment to an administrator.'
                );
        }

        // Proses persetujuan pengembalian oleh admin
        DB::transaction(function () use ($borrowing) {
            $lockedBorrowing = Borrowing::whereKey($borrowing->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Hanya permintaan yang menunggu persetujuan yang dapat diproses
            if ($lockedBorrowing->status !== 'Pending Approval') {
                throw ValidationException::withMessages([
                    'status' => 'This borrowing is not awaiting return approval.',
                ]);
            }

            $equipment = Equipment::whereKey($lockedBorrowing->equipment_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Stok ditambahkan sekali saat admin menyetujui
            $equipment->increment(
                'quantity',
                $lockedBorrowing->quantity
            );

            $lockedBorrowing->update([
                'status' => 'Returned',
                'returned_at' => now()->toDateString(),
            ]);
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Equipment return approved successfully.');
    }

    // Riwayat peminjaman tidak dihapus
    public function destroy(Borrowing $borrowing)
    {
        return redirect()
            ->route('borrowings.index')
            ->with('error', 'Borrowing records cannot be deleted.');
    }
}
