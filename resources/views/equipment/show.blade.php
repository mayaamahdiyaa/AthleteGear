
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Details | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/equipment-show.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();

        $stock = (int) $equipment->quantity;
        $minimum = (int) $equipment->minimum_stock;

        $stockClass = $stock <= 0
            ? 'status-out'
            : ($stock <= $minimum ? 'status-low' : 'status-available');

        $stockLabel = $stock <= 0
            ? 'Out of Stock'
            : ($stock <= $minimum ? 'Low Stock' : 'Available');

        $condition = strtolower($equipment->condition ?? '');

        $conditionClass = str_contains($condition, 'poor')
            ? 'condition-poor'
            : (str_contains($condition, 'fair') ? 'condition-fair' : '');
    @endphp

    <x-sidebar />

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">ATHLETEGEAR / EQUIPMENT CONTROL</div>

            <div class="user-area">
                <div class="avatar">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <div class="user-info">
                    <strong>{{ $user->name ?? 'User' }}</strong>
                    <span>{{ $user->role ?? 'Athlete' }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">↗ Logout</button>
                </form>
            </div>
        </header>

        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow">ATHLETEGEAR / PERFORMANCE EQUIPMENT</p>
                <h1>Equipment<br>Details</h1>
                <p class="hero-subtitle">Everything you need to know about your gear.</p>
            </div>

            <div class="hero-note">
                EQUIPMENT FOR DETERMINING<br>
                THE PERFORMANCE OF<br>
                STRONG ATHLETES
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

            <div class="page-heading">
                <div>
                    <p class="section-eyebrow">INVENTORY MANAGEMENT / OVERVIEW</p>
                    <h2 class="section-title">Equipment Details</h2>
                    <p class="section-description">
                        View stock, condition, and information for this equipment.
                    </p>
                </div>

                <a href="{{ route('equipment.index') }}" class="button button-outline">
                    ← Back to Inventory
                </a>
            </div>

            <div class="detail-card">
                <div class="detail-card-header">

                    <div class="equipment-heading">
                        <h2>{{ $equipment->name }}</h2>
                        <p>
                            Equipment ID: #{{ $equipment->id }}
                            ·
                            {{ $equipment->category->name ?? 'Uncategorized' }}
                        </p>
                    </div>
                </div>

                <div class="detail-body">
                    <h3 class="detail-section-title">Equipment Information</h3>

                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Equipment Name</span>
                            <span class="detail-value">{{ $equipment->name }}</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Category</span>
                            <span class="detail-value">
                                <span class="category-badge">
                                    {{ $equipment->category->name ?? 'Uncategorized' }}
                                </span>
                            </span>
                        </div>

                        <div class="detail-item description-item">
                            <span class="detail-label">Description</span>
                            <span class="detail-value description-value">{{ $equipment->description ?: 'No description has been added for this equipment.' }}</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Available Stock</span>
                            <span class="detail-value">{{ $stock }} units</span>
                            <span class="status {{ $stockClass }}" style="margin-top: 9px;">
                                {{ $stockLabel }}
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Minimum Stock</span>
                            <span class="detail-value">{{ $minimum }} units</span>

                            @if ($stock <= $minimum)
                                <p class="section-description" style="margin-bottom:0;">
                                    Stock has reached the minimum level.
                                </p>
                            @else
                                <p class="section-description" style="margin-bottom:0;">
                                    Stock is above the minimum level.
                                </p>
                            @endif
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Equipment Condition</span>
                            <span class="detail-value">
                                <span class="condition {{ $conditionClass }}">
                                    {{ $equipment->condition ?: 'Not specified' }}
                                </span>
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Date Added</span>
                            <span class="detail-value">
                                {{ $equipment->created_at ? $equipment->created_at->format('d M Y, H:i') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="detail-footer">
                    <div class="created-info">
                        <strong>ATHLETEGEAR INVENTORY</strong><br>
                        Equipment record #{{ $equipment->id }}
                    </div>

                    <div class="detail-actions">
                        <a href="{{ route('equipment.index') }}" class="button button-outline">
                            ← Back
                        </a>

                        @if ($isAdmin)
                            <a href="{{ route('equipment.edit', $equipment) }}" class="button button-primary">
                                ✎ Edit Equipment
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <footer class="page-footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>
</body>
</html>
