
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Equipment - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Add New Equipment</h2>

    <a href="{{ route('equipment.index') }}">Back to Equipment</a>

    @if ($categories->isEmpty())
        <p>
            You need to create a category first.
            <a href="{{ route('categories.create') }}">Add Category</a>
        </p>
    @else
        <form action="{{ route('equipment.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Equipment Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    maxlength="150"
                >
                @error('name')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
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
                >{{ old('description') }}</textarea>
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
                    value="{{ old('quantity', 0) }}"
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
                    value="{{ old('minimum_stock', 1) }}"
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
                    <option value="Good" {{ old('condition', 'Good') == 'Good' ? 'selected' : '' }}>Good</option>
                    <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                    <option value="Damaged" {{ old('condition') == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                </select>
                @error('condition')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Save Equipment</button>
        </form>
    @endif
</body>
</html>
