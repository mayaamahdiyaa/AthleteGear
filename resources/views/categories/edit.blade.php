
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Edit Category</h2>

    <a href="{{ route('categories.index') }}">Back to Categories</a>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Category Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
                required
                maxlength="100"
            >

            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                maxlength="1000"
            >{{ old('description', $category->description) }}</textarea>

            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update Category</button>
    </form>
</body>
</html>
