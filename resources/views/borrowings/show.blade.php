
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Details - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Borrowing Details</h2>

    <a href="{{ route('borrowings.index') }}">Back to Borrowings</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Borrower</th>
            <td>{{ $borrowing->user->name }}</td>
        </tr>
        <tr>
            <th>Equipment</th>
            <td>{{ $borrowing->equipment->name }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $borrowing->equipment->category->name }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $borrowing->quantity }}</td>
        </tr>
        <tr>
            <th>Borrowed Date</th>
            <td>{{ $borrowing->borrowed_at->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
        </tr>
        <tr>
            <th>Returned Date</th>
            <td>{{ $borrowing->returned_at?->format('d M Y') ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $borrowing->status }}</td>
        </tr>
    </table>
</body>
</html>
