
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Details | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/borrowings-show.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();

        $status = strtolower($borrowing->status ?? 'borrowed');

        $isOverdue = $status === 'borrowed'
            && $borrowing->due_date
            && $borrowing->due_date->lt(today());

        $statusClass = $status === 'returned'
            ? 'status-returned'
            : ($isOverdue ? 'status-overdue' : 'status-borrowed');

        $statusLabel = $isOverdue ? 'Overdue' : ucfirst($status);
    @endphp

    <x-sidebar />

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">ATHLETEGEAR / BORROWING CONTROL</div>

            <div class="user-area">
                <div class="avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="user-info">
                    <strong>{{ $user->name }}</strong>
                    <span>{{ $user->role }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">↗ Logout</button>
                </form>
            </div>
        </header>

        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow">ATHLETEGEAR / EQUIPMENT MANAGEMENT</p>
                <h1>Borrowing<br>Details</h1>
                <p class="hero-subtitle">Review equipment and return information.</p>
            </div>

            <div class="hero-note">
                BORROW SMART<br>
                RETURN ON TIME<br>
                TRAIN HARDER
                <span></span>
            </div>
        </section>

        <section class="content">
            @if (session('success'))
                <div class="flash success" role="status">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="flash error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <a href="{{ route('borrowings.index') }}" class="back-link">
                ← Back to Borrowings
            </a>

            <div class="details-card">
                <div class="details-header">
                    <div>
                        <h2>Borrowing Information</h2>
                        <p>Check the borrowing details and current equipment status below.</p>
                    </div>

                    <span class="status {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="details-grid">
                    @if ($isAdmin)
                        <div class="detail-item">
                            <span class="detail-label">Borrower</span>
                            <span class="detail-value">
                                {{ $borrowing->user->name ?? 'Unknown User' }}
                            </span>
                            <span class="detail-hint">
                                {{ $borrowing->user->email ?? 'Email unavailable' }}
                            </span>
                        </div>
                    @endif

                    <div class="detail-item">
                        <span class="detail-label">Equipment</span>
                        <span class="detail-value">
                            {{ $borrowing->equipment->name ?? 'Equipment unavailable' }}
                        </span>
                        <span class="detail-hint">
                            {{ $borrowing->equipment->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Quantity</span>
                        <span class="detail-value">
                            {{ $borrowing->quantity }} unit(s)
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Borrowed Date</span>
                        <span class="detail-value">
                            {{ $borrowing->borrowed_at?->format('d M Y') ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Due Date</span>
                        <span class="detail-value">
                            {{ $borrowing->due_date?->format('d M Y') ?? 'Not set' }}
                        </span>
                        @if ($isOverdue)
                            <span class="detail-hint">This borrowing is past its due date.</span>
                        @endif
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Returned Date</span>
                        <span class="detail-value">
                            {{ $borrowing->returned_at?->format('d M Y') ?? 'Not returned yet' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Borrowing Record</span>
                        <span class="detail-value">
                            #{{ $borrowing->id }}
                        </span>
                        <span class="detail-hint">AthleteGear borrowing reference</span>
                    </div>
                </div>

                <div class="details-footer">
                    <span class="footer-note">
                        Keep track of due dates and return borrowed equipment on time.
                    </span>

                    <a href="{{ route('borrowings.index') }}" class="button button-primary">
                        Back to Borrowings
                    </a>
                </div>
            </div>

            <footer class="page-footer">
                ATHLETEGEAR · TRACK &amp; FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>
</body>
</html>
