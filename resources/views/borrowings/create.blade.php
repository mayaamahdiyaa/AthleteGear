
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Borrowing - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Borrow Equipment</h2>

    <a href="{{ route('borrowings.index') }}">Back to Borrowings</a>

    @if ($equipment->isEmpty())
        <p>No equipment is currently available to borrow.</p>
        <a href="{{ route('equipment.index') }}">View Equipment</a>
    @else
        <form action="{{ route('borrowings.store') }}" method="POST">
            @csrf

            <div>
                <label for="equipment_id">Equipment</label>
                <select id="equipment_id" name="equipment_id" required>
                    <option value="">Select Equipment</option>

                    @foreach ($equipment as $item)
                        <option
                            value="{{ $item->id }}"
                            {{ old('equipment_id') == $item->id ? 'selected' : '' }}
                        >
                            {{ $item->name }}
                            — {{ $item->category->name }}
                            (Available: {{ $item->quantity }})
                        </option>
                    @endforeach
                </select>

                @error('equipment_id')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="quantity">Quantity to Borrow</label>
                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="{{ old('quantity', 1) }}"
                    min="1"
                    required
                >

                @error('quantity')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="due_date">Due Date (Optional)</label>
                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                    min="{{ now()->toDateString() }}"
                >

                @error('due_date')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Confirm Borrowing</button>
        </form>
    @endif
</body>
</html>
