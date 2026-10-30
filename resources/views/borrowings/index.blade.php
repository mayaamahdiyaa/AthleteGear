
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Records | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/borrowings-index.css'])
</head>

<body>
@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();
@endphp

<x-sidebar />

<main class="main">
    <header class="topbar">
        <div class="topbar-title">ATHLETEGEAR / BORROWING CONTROL</div>

        <div class="user-area">
            <a href="{{ route('profile.show') }}"
               class="profile-link"
               aria-label="Open profile">

                <div class="avatar">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <div class="user-info">
                    <strong>{{ $user->name }}</strong>
                    <span>{{ $user->role }}</span>
                </div>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">↗ Logout</button>
            </form>
        </div>
    </header>

    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">ATHLETEGEAR / EQUIPMENT MANAGEMENT</p>
            <h1>Borrowing<br>Records</h1>
            <p class="hero-subtitle">Track your gear. Stay ready.</p>
        </div>
        <div class="hero-note">
            BORROW SMART<br>RETURN ON TIME<br>TRAIN HARDER
            <span></span>
        </div>
    </section>

    <section class="content">
        @if (session('success'))
            <div class="flash success" role="status">✓ {{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="flash error" role="alert">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="flash error" role="alert">
                <strong>Please check the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="toolbar">
            <form class="search-form" role="search" onsubmit="return false;">
                <input class="search-input" type="search" id="borrowingSearch"
                    placeholder="⌕ Search borrower or equipment..."
                    aria-label="Search borrowing records">
            </form>

            <div class="toolbar-action">
                <a href="{{ route('borrowings.create') }}" class="button button-primary">
                    <span style="font-size:17px;">+</span> New Borrowing
                </a>
                <p class="admin-note">
                    {{ $isAdmin ? '♟ Admin view · All records' : '◷ Your borrowing records' }}
                </p>
            </div>
        </div>

        <div class="table-card">
            @if ($borrowings->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">◷</div>
                    <h2>No Borrowing Records Yet</h2>
                    <p>Your borrowing history will appear here once equipment is borrowed.</p>
                    <a href="{{ route('borrowings.create') }}" class="button button-primary">+ Create First Borrowing</a>
                </div>
            @else
                <div class="table-scroll">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                @if ($isAdmin)
                                    <th>Borrower</th>
                                @endif
                                <th>Equipment</th>
                                <th>Quantity</th>
                                <th>Borrowed Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="borrowingTableBody">
                            @foreach ($borrowings as $borrowing)
                                @php
                                    $status = strtolower($borrowing->status ?? 'borrowed');

                                    $isOverdue = $status === 'borrowed'
                                        && $borrowing->due_date
                                        && $borrowing->due_date->lt(today());

                                    $statusClass = match ($status) {
                                        'returned' => 'status-returned',
                                        'pending approval' => 'status-pending',
                                        default => $isOverdue ? 'status-overdue' : 'status-borrowed',
                                    };

                                    $statusLabel = $isOverdue ? 'Overdue' : ucwords($status);
                                @endphp

                                <tr class="borrowing-row">
                                    <td class="number-cell">{{ $loop->iteration }}</td>

                                    @if ($isAdmin)
                                        <td class="borrower-name">
                                            {{ $borrowing->user->name ?? 'Unknown User' }}
                                            <span class="secondary-text">{{ $borrowing->user->email ?? '' }}</span>
                                        </td>
                                    @endif

                                    <td class="equipment-name">
                                        <a href="{{ route('borrowings.show', $borrowing) }}">
                                            {{ $borrowing->equipment->name ?? 'Equipment unavailable' }}
                                        </a>
                                        <span class="secondary-text">
                                            {{ $borrowing->equipment->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="quantity-number">{{ $borrowing->quantity }}</span>
                                        <span class="secondary-text">unit(s)</span>
                                    </td>

                                    <td class="date-text">
                                        {{ $borrowing->borrowed_at ? $borrowing->borrowed_at->format('d M Y') : '-' }}
                                    </td>

                                    <td class="date-text">
                                        {{ $borrowing->due_date ? $borrowing->due_date->format('d M Y') : 'Not set' }}
                                    </td>

                                    <td>
                                        <span class="status {{ $statusClass }}">{{ $statusLabel }}</span>

                                        @if ($status === 'pending approval')
                                            <span class="secondary-text">Waiting for admin verification</span>
                                        @endif

                                        @if ($status === 'returned' && $borrowing->returned_at)
                                            <span class="secondary-text">{{ $borrowing->returned_at->format('d M Y') }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('borrowings.show', $borrowing) }}" class="button button-dark">◉ View</a>

                                            @if (! $isAdmin && $status === 'borrowed')
                                                <form action="{{ route('borrowings.update', $borrowing) }}"
                                                      method="POST" class="return-form"
                                                      onsubmit="return confirm('Submit a return request for this equipment? Please make sure you are ready to hand it over to an administrator.')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="button button-outline">↩ Request Return</button>
                                                </form>
                                            @elseif ($isAdmin && $status === 'pending approval')
                                                <form action="{{ route('borrowings.update', $borrowing) }}"
                                                      method="POST" class="return-form"
                                                      onsubmit="return confirm('Approve this equipment return? The stock will be increased.')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="button button-approve">✓ Approve Return</button>
                                                </form>
                                            @elseif ($isAdmin && $status === 'borrowed')
                                                <span class="secondary-text">Awaiting athlete request</span>
                                            @elseif ($status === 'pending approval')
                                                <span class="secondary-text">Request submitted</span>
                                            @elseif ($status === 'returned')
                                                <span class="secondary-text">Return completed</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span class="legend"><span class="legend-dot" style="background:#F4AD35;"></span>Borrowed</span>
                    <span class="legend"><span class="legend-dot" style="background:#E3B72F;"></span>Pending Approval</span>
                    <span class="legend"><span class="legend-dot" style="background:#329464;"></span>Returned</span>
                    <span class="legend"><span class="legend-dot" style="background:#D94343;"></span>Overdue</span>
                </div>
            @endif
        </div>

        <footer class="page-footer">ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT</footer>
    </section>
</main>

<script>
    const borrowingSearch = document.getElementById('borrowingSearch');

    if (borrowingSearch) {
        borrowingSearch.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();

            document.querySelectorAll('.borrowing-row').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
            });
        });
    }
</script>
</body>
</html>
