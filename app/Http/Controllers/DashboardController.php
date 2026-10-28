<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        // Statistik equipment
        $totalEquipment = Equipment::count();

        $availableStock = Equipment::sum('quantity');

        $lowStockCount = Equipment::whereColumn(
            'quantity',
            '<=',
            'minimum_stock'
        )->count();

        // Query peminjaman mengikuti role pengguna
        $borrowingsQuery = Borrowing::query();

        if (! $isAdmin) {
            $borrowingsQuery->where('user_id', $user->id);
        }

        // Statistik peminjaman
        $activeBorrowings = (clone $borrowingsQuery)
            ->where('status', 'Borrowed')
            ->count();

        $pendingReturns = (clone $borrowingsQuery)
            ->where('status', 'Pending Approval')
            ->count();

        $returnedBorrowings = (clone $borrowingsQuery)
            ->where('status', 'Returned')
            ->count();

        // Data peminjaman terbaru
        $recentBorrowings = (clone $borrowingsQuery)
            ->with(['user', 'equipment.category'])
            ->latest()
            ->take(5)
            ->get();

        // Equipment dengan stok rendah
        $lowStockEquipment = Equipment::with('category')
            ->whereColumn('quantity', '<=', 'minimum_stock')
            ->orderBy('quantity')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'isAdmin',
            'totalEquipment',
            'availableStock',
            'lowStockCount',
            'activeBorrowings',
            'pendingReturns',
            'returnedBorrowings',
            'recentBorrowings',
            'lowStockEquipment'
        ));
    }
}
