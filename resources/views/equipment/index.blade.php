<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Equipment Inventory</h2>

    <p>
        Logged in as: {{ auth()->user()->name }}
        ({{ auth()->user()->role }})
    </p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <p>
        <a href="{{ route('equipment.index') }}">Equipment</a>
        |
        <a href="{{ route('borrowings.index') }}">Borrowing Records</a>

        @if (auth()->user()->isAdmin())
            |
            <a href="{{ route('categories.index') }}">Manage Categories</a>
            |
            <a href="{{ route('equipment.create') }}">+ Add Equipment</a>
        @endif
    </p>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if ($equipment->isEmpty())
        <p>No equipment yet. Add your first equipment!</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Available Stock</th>
                    <th>Minimum Stock</th>
                    <th>Condition</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipment as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name ?? 'Uncategorized' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->minimum_stock }}</td>
                        <td>{{ $item->condition }}</td>
                        <td>
                            <a href="{{ route('equipment.show', $item) }}">View</a>

                            @if (auth()->user()->isAdmin())
                                |
                                <a href="{{ route('equipment.edit', $item) }}">Edit</a>
                                |
                                <form
                                    action="{{ route('equipment.destroy', $item) }}"
                                    method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Delete this equipment?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
