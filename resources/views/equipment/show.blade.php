
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Details - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Equipment Details</h2>

    <a href="{{ route('equipment.index') }}">Back to Equipment</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Equipment Name</th>
            <td>{{ $equipment->name }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $equipment->category->name }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $equipment->description ?? '-' }}</td>
        </tr>
        <tr>
            <th>Available Stock</th>
            <td>{{ $equipment->quantity }}</td>
        </tr>
        <tr>
            <th>Minimum Stock</th>
            <td>{{ $equipment->minimum_stock }}</td>
        </tr>
        <tr>
            <th>Condition</th>
            <td>{{ $equipment->condition }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $equipment->created_at->format('d M Y, H:i') }}</td>
        </tr>
    </table>

    <p>
        <a href="{{ route('equipment.edit', $equipment) }}">Edit Equipment</a>
    </p>
</body>
</html>
