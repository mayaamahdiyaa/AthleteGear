
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/dashboard.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <x-sidebar />

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">ATHLETEGEAR / PERFORMANCE DASHBOARD</div>

            <div class="user-area">
                <a href="{{ route('profile.show') }}" class="profile-link" aria-label="Open profile">
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
                <p class="eyebrow">ATHLETEGEAR / TRACK & FIELD MANAGEMENT</p>

                <h1>
                    {{ $isAdmin ? 'Control Your Inventory.' : 'Ready to Perform.' }}
                </h1>

                <p class="hero-subtitle">
                    @if ($isAdmin)
                        Monitor equipment, stock levels, and borrowing activity in one place.
                    @else
                        Check available equipment and keep track of your borrowing activity.
                    @endif
                </p>
            </div>

            <div class="hero-note">
                BUILT FOR ATHLETES.<br>
                READY FOR EVERY<br>
                TRAINING SESSION.
                <span></span>
            </div>
        </section>

        <div class="content">
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

            <div class="section-heading">
                <h2>Overview</h2>
            </div>

            <section class="stats">
                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Equipment Types</div>
                        <div class="stat-icon">EQ</div>
                    </div>
                    <div class="stat-value">{{ $totalEquipment }}</div>
                    <div class="stat-note">Registered equipment types</div>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Available Units</div>
                        <div class="stat-icon">ST</div>
                    </div>
                    <div class="stat-value">{{ $availableStock }}</div>
                    <div class="stat-note">Units currently in stock</div>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Active Borrowings</div>
                        <div class="stat-icon">BR</div>
                    </div>
                    <div class="stat-value">{{ $activeBorrowings }}</div>
                    <div class="stat-note">Currently borrowed</div>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">
                            {{ $isAdmin ? 'Pending Returns' : 'Return Requests' }}
                        </div>
                        <div class="stat-icon">RT</div>
                    </div>
                    <div class="stat-value">{{ $pendingReturns }}</div>
                    <div class="stat-note">
                        {{ $isAdmin ? 'Awaiting your approval' : 'Waiting for admin approval' }}
                    </div>
                </article>
            </section>

            <div class="section-heading">
                <h2>Recent Borrowings</h2>
                <a href="{{ route('borrowings.index') }}">View all →</a>
            </div>

            <section class="panel">
                @if ($recentBorrowings->isNotEmpty())
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    @if ($isAdmin)
                                        <th>Athlete</th>
                                    @endif
                                    <th>Equipment</th>
                                    <th>Quantity</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($recentBorrowings as $borrowing)
                                    @php
                                        $status = strtolower($borrowing->status ?? '');

                                        $statusClass = match ($status) {
                                            'returned' => 'badge-returned',
                                            'pending approval' => 'badge-pending',
                                            'borrowed' => 'badge-borrowed',
                                            default => 'badge-other',
                                        };
                                    @endphp

                                    <tr>
                                        @if ($isAdmin)
                                            <td>{{ $borrowing->user->name ?? 'Unknown user' }}</td>
                                        @endif

                                        <td>{{ $borrowing->equipment->name ?? 'Equipment unavailable' }}</td>
                                        <td>{{ $borrowing->quantity }}</td>
                                        <td>{{ $borrowing->due_date?->format('d M Y') ?? '—' }}</td>
                                        <td>
                                            <span class="badge {{ $statusClass }}">
                                                {{ $borrowing->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty">No borrowing activity yet.</div>
                @endif
            </section>

            @if ($isAdmin)
                <div class="lower-grid">
                    <section class="panel">
                        <div class="panel-header">
                            <h3>Low Stock Equipment</h3>
                            <a href="{{ route('equipment.index') }}">View equipment →</a>
                        </div>

                        @forelse ($lowStockEquipment as $equipment)
                            <div class="stock-item">
                                <div>
                                    <div class="stock-name">{{ $equipment->name }}</div>
                                    <div class="stock-category">
                                        {{ $equipment->category->name ?? 'Uncategorized' }}
                                    </div>
                                </div>
                                <div class="stock-number">{{ $equipment->quantity }} left</div>
                            </div>
                        @empty
                            <div class="empty">All equipment is above its minimum stock level.</div>
                        @endforelse
                    </section>

                    <section class="panel">
                        <div class="panel-header">
                            <h3>Inventory Summary</h3>
                        </div>

                        <div class="stock-item">
                            <span>Total equipment types</span>
                            <strong>{{ $totalEquipment }}</strong>
                        </div>

                        <div class="stock-item">
                            <span>Total available units</span>
                            <strong>{{ $availableStock }}</strong>
                        </div>

                        <div class="stock-item">
                            <span>Low stock items</span>
                            <strong class="stock-number">{{ $lowStockCount }}</strong>
                        </div>

                        <div class="stock-item">
                            <span>Returned borrowings</span>
                            <strong>{{ $returnedBorrowings }}</strong>
                        </div>
                    </section>
                </div>
            @else
                <div class="section-heading">
                    <h2>Quick Actions</h2>
                </div>

                <section class="panel">
                    <div class="stock-item">
                        <div>
                            <div class="stock-name">Explore Equipment</div>
                            <div class="stock-category">Find equipment available for borrowing.</div>
                        </div>
                        <a href="{{ route('equipment.index') }}" class="quick-link">View →</a>
                    </div>

                    <div class="stock-item">
                        <div>
                            <div class="stock-name">My Borrowings</div>
                            <div class="stock-category">Check your borrowing and return status.</div>
                        </div>
                        <a href="{{ route('borrowings.index') }}" class="quick-link">View →</a>
                    </div>
                </section>
            @endif

            <footer class="footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </div>
    </main>
</body>
</html>
