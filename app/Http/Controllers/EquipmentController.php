<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    /**
     * Aturan validasi untuk foto peralatan (opsional).
     */
    private function imageRules(): array
    {
        return ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'];
    }

    // Menampilkan semua peralatan
    public function index()
    {
        $equipment = Equipment::with('category')
            ->latest()
            ->get();

        return view('equipment.index', compact('equipment'));
    }

    // Menampilkan form tambah peralatan
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('equipment.create', compact('categories'));
    }

    // Menyimpan peralatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'image' => $this->imageRules(),
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'condition' => ['required', Rule::in(['Good', 'Fair', 'Damaged'])],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('equipment', 'public');
        } else {
            unset($validated['image']);
        }

        Equipment::create($validated);

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment added successfully.');
    }

    // Menampilkan detail peralatan
    public function show(Equipment $equipment)
    {
        $equipment->load('category');

        return view('equipment.show', compact('equipment'));
    }

    // Menampilkan form edit peralatan
    public function edit(Equipment $equipment)
    {
        $categories = Category::orderBy('name')->get();

        return view('equipment.edit', compact('equipment', 'categories'));
    }

    // Memperbarui data peralatan
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'image' => $this->imageRules(),
            'remove_image' => 'nullable|boolean',
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'condition' => ['required', Rule::in(['Good', 'Fair', 'Damaged'])],
        ]);

        $removeImage = $request->boolean('remove_image');
        $oldImage = $equipment->image;
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('equipment', 'public');
        }

        $validated['image'] = $newImage ?? ($removeImage ? null : $oldImage);
        unset($validated['remove_image']);

        // Simpan ke database terlebih dahulu. File foto lama hanya dihapus
        // setelah penyimpanan berhasil, agar foto lama tidak hilang percuma.
        if (! $equipment->update($validated)) {
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }

            return redirect()
                ->route('equipment.edit', $equipment)
                ->with('error', 'Equipment failed to update. No changes were saved.');
        }

        // Penyimpanan berhasil: baru hapus file lama (diganti atau dihapus).
        if ($oldImage && $oldImage !== $equipment->image) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    // Menghapus peralatan
    public function destroy(Equipment $equipment)
    {
        if ($equipment->borrowings()->exists()) {
            return redirect()
                ->route('equipment.index')
                ->with('error', 'Cannot delete equipment with borrowing records.');
        }

        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image);
        }

        $equipment->delete();

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}
