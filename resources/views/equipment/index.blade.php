<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Inventory | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/equipment-index.css'])
</head>
<body>
    @php
        $user = auth()->user();
        $isAdmin = $user->isAdmin();
    @endphp

    <x-sidebar />

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">ATHLETEGEAR / EQUIPMENT CONTROL</div>

            <div class="user-area">
                <!-- Avatar dan nama user menuju halaman Profile -->
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
                <p class="eyebrow">ATHLETEGEAR / PERFORMANCE EQUIPMENT</p>
                <h1>Equipment<br>Inventory</h1>
                <p class="hero-subtitle">Gear up. Train harder.</p>
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
                    <input class="search-input" type="search" id="equipmentSearch"
                        placeholder="⌕  Search equipment by name..."
                        aria-label="Search equipment by name">
                </form>

                @if ($isAdmin)
                    <div class="toolbar-action">
                        <a href="{{ route('equipment.create') }}" class="button button-primary">
                            <span style="font-size:17px">+</span> Add Equipment
                        </a>
                        <p class="admin-note">♟ Admin only</p>
                    </div>
                @endif
            </div>

            <div class="table-card">
                @if ($equipment->isEmpty())
                    <div class="empty-state">
                        <h2>No Equipment Yet</h2>
                        <p>Your equipment inventory is ready for its first entry.</p>

                        @if ($isAdmin)
                            <a href="{{ route('equipment.create') }}" class="button button-primary">
                                + Add First Equipment
                            </a>
                        @endif
                    </div>
                @else
                    <div class="table-scroll">
                        <table class="inventory-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Equipment Name</th>
                                    <th>Category</th>
                                    <th>Available Stock</th>
                                    <th>Minimum Stock</th>
                                    <th>Condition</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="equipmentTableBody">
                                @foreach ($equipment as $item)
                                    @php
                                        $stock = (int) $item->quantity;
                                        $minimum = (int) $item->minimum_stock;

                                        $stockClass = $stock <= 0
                                            ? 'status-out'
                                            : ($stock <= $minimum ? 'status-low' : 'status-available');

                                        $stockLabel = $stock <= 0
                                            ? 'Out of Stock'
                                            : ($stock <= $minimum ? 'Low Stock' : 'Available');

                                        $condition = strtolower($item->condition ?? '');

                                        $conditionClass = str_contains($condition, 'poor')
                                            ? 'condition-poor'
                                            : (str_contains($condition, 'fair') ? 'condition-fair' : 'condition-good');

                                        $name = strtolower($item->name);

                                        if (str_contains($name, 'hurdle')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Athletics hurdle';
                                        } elseif (str_contains($name, 'block')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Athletics training';
                                        } elseif (str_contains($name, 'baton')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Sports equipment';
                                        } elseif (str_contains($name, 'cone')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Sports training';
                                        } elseif (str_contains($name, 'ball')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1519861531473-9200262188bf?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Sports ball';
                                        } elseif (str_contains($name, 'band') || str_contains($name, 'peluru') || str_contains($name, 'shot put')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Athletics training equipment';
                                        } elseif (str_contains($name, 'mat')) {
                                            $imageUrl = 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Exercise mat';
                                        } else {
                                            $imageUrl = 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=180&q=80';
                                            $imageAlt = 'Sports equipment';
                                        }
                                    @endphp

                                    <tr class="equipment-row">
                                        <td class="number-cell">{{ $loop->iteration }}</td>

                                        <td>
                                            <img class="equipment-image"
                                                src="{{ $imageUrl }}" alt="{{ $imageAlt }}"
                                                loading="lazy"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                            <div class="equipment-image image-fallback"
                                                style="display:none;place-items:center;font-size:25px"
                                                aria-hidden="true">🏃</div>
                                        </td>

                                        <td class="equipment-name">
                                            <a href="{{ route('equipment.show', $item) }}">{{ $item->name }}</a>
                                        </td>

                                        <td>
                                            <span class="category-badge">
                                                {{ $item->category->name ?? 'Uncategorized' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="stock-number">{{ $stock }}</span>
                                            <span class="status {{ $stockClass }}">{{ $stockLabel }}</span>
                                        </td>

                                        <td>{{ $minimum }}</td>

                                        <td>
                                            <span class="condition {{ $conditionClass }}">
                                                {{ $item->condition }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('equipment.show', $item) }}" class="button button-dark">◉ View</a>

                                                @if ($isAdmin)
                                                    <a href="{{ route('equipment.edit', $item) }}"
                                                        class="button button-outline"
                                                        aria-label="Edit {{ $item->name }}"
                                                        title="Edit equipment">✎</a>

                                                    <form action="{{ route('equipment.destroy', $item) }}"
                                                        method="POST" class="delete-form"
                                                        onsubmit="return confirm('Delete this equipment?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button button-danger"
                                                            aria-label="Delete {{ $item->name }}"
                                                            title="Delete equipment">♜</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <span class="legend"><span class="legend-dot" style="background:#329464"></span>Available</span>
                        <span class="legend"><span class="legend-dot" style="background:#F4AD35"></span>Low Stock</span>
                        <span class="legend"><span class="legend-dot" style="background:#D94343"></span>Out of Stock</span>
                    </div>
                @endif
            </div>

            <footer class="page-footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>

    <script>
        const equipmentSearch = document.getElementById('equipmentSearch');

        if (equipmentSearch) {
            equipmentSearch.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();

                document.querySelectorAll('.equipment-row').forEach(function (row) {
                    row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>
