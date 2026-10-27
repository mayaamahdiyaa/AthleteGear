
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Equipment - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Edit Equipment</h2>

    <a href="{{ route('equipment.index') }}">Back to Equipment</a>

    <form action="{{ route('equipment.update', $equipment) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Equipment Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $equipment->name) }}"
                maxlength="150"
                required
            >
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $equipment->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                maxlength="1000"
            >{{ old('description', $equipment->description) }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="quantity">Available Stock</label>
            <input
                type="number"
                id="quantity"
                name="quantity"
                value="{{ old('quantity', $equipment->quantity) }}"
                min="0"
                required
            >
            @error('quantity')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="minimum_stock">Minimum Stock</label>
            <input
                type="number"
                id="minimum_stock"
                name="minimum_stock"
                value="{{ old('minimum_stock', $equipment->minimum_stock) }}"
                min="0"
                required
            >
            @error('minimum_stock')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="condition">Condition</label>
            <select id="condition" name="condition" required>
                @foreach (['Good', 'Fair', 'Damaged'] as $condition)
                    <option
                        value="{{ $condition }}"
                        {{ old('condition', $equipment->condition) == $condition ? 'selected' : '' }}
                    >
                        {{ $condition }}
                    </option>
                @endforeach
            </select>
            @error('condition')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update Equipment</button>
    </form>
</body>
</html>
