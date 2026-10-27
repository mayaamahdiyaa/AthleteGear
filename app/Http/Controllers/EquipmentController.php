<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
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
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'condition' => ['required', Rule::in(['Good', 'Fair', 'Damaged'])],
        ]);

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
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'condition' => ['required', Rule::in(['Good', 'Fair', 'Damaged'])],
        ]);

        $equipment->update($validated);

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

        $equipment->delete();

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}
