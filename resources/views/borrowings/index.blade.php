
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowings - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Borrowing Records</h2>

    <p>
        <a href="{{ route('equipment.index') }}">Manage Equipment</a>
        |
        <a href="{{ route('borrowings.create') }}">+ New Borrowing</a>
    </p>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if ($borrowings->isEmpty())
        <p>No borrowing records yet.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Borrower</th>
                    <th>Equipment</th>
                    <th>Quantity</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowings as $borrowing)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrowing->user->name }}</td>
                        <td>{{ $borrowing->equipment->name }}</td>
                        <td>{{ $borrowing->quantity }}</td>
                        <td>{{ $borrowing->borrowed_at->format('d M Y') }}</td>
                        <td>
                            {{ $borrowing->due_date?->format('d M Y') ?? '-' }}
                        </td>
                        <td>{{ $borrowing->status }}</td>
                        <td>
                            <a href="{{ route('borrowings.show', $borrowing) }}">
                                View
                            </a>

                            @if ($borrowing->status === 'Borrowed')
                                |
                                <form
                                    action="{{ route('borrowings.update', $borrowing) }}"
                                    method="POST"
                                    style="display: inline;"
                                >
                                    @csrf
                                    @method('PUT')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Confirm equipment return?')"
                                    >
                                        Return
                                    </button>
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
