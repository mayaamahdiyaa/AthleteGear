<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/categories-index.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <x-sidebar />

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">ATHLETEGEAR / CATEGORY CONTROL</div>

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
                <p class="eyebrow">ATHLETEGEAR / PERFORMANCE EQUIPMENT</p>
                <h1>Equipment<br>Categories</h1>
                <p class="hero-subtitle">Organize your gear. Train smarter.</p>
            </div>

            <div class="hero-note">
                EVERY ITEM<br>
                HAS ITS PLACE<br>
                STAY ORGANIZED
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
                    <input
                        class="search-input"
                        type="search"
                        id="categorySearch"
                        placeholder="⌕ Search category by name or description..."
                        aria-label="Search categories">
                </form>

                @if ($isAdmin)
                    <div class="toolbar-action">
                        <a href="{{ route('categories.create') }}" class="button button-primary">
                            <span style="font-size:17px;">+</span> Add Category
                        </a>
                        <p class="admin-note">♟ Admin only</p>
                    </div>
                @endif
            </div>

            <div class="table-card">
                @if ($categories->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">▦</div>
                        <h2>No Categories Yet</h2>
                        <p>Create your first category to organize the equipment inventory.</p>

                        @if ($isAdmin)
                            <a href="{{ route('categories.create') }}" class="button button-primary">
                                + Add First Category
                            </a>
                        @endif
                    </div>
                @else
                    <div class="table-scroll">
                        <table class="inventory-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    @if ($isAdmin)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody id="categoryTableBody">
                                @foreach ($categories as $category)
                                    <tr class="category-row">
                                        <td class="number-cell">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="category-name">
                                            <span class="category-badge">
                                                ▦ {{ $category->name }}
                                            </span>
                                        </td>

                                        <td class="category-description">
                                            {{ $category->description ?: 'No description provided.' }}
                                        </td>

                                        @if ($isAdmin)
                                            <td>
                                                <div class="actions">
                                                    <a
                                                        href="{{ route('categories.edit', $category) }}"
                                                        class="button button-outline"
                                                        title="Edit category"
                                                        aria-label="Edit {{ $category->name }}">
                                                        ✎ Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('categories.destroy', $category) }}"
                                                        method="POST"
                                                        class="delete-form"
                                                        onsubmit="return confirm('Delete this category?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="button button-danger"
                                                            title="Delete category"
                                                            aria-label="Delete {{ $category->name }}">
                                                            ♜ Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <span class="legend">
                            <span class="legend-dot" style="background:#D94343;"></span>
                            Equipment Categories
                        </span>

                        <span class="legend">
                            Total categories:
                            <strong>{{ $categories->count() }}</strong>
                        </span>
                    </div>
                @endif
            </div>

            <footer class="page-footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>

    <script>
        // Search kategori berdasarkan nama atau deskripsi.
        const categorySearch = document.getElementById('categorySearch');

        if (categorySearch) {
            categorySearch.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();

                document.querySelectorAll('.category-row').forEach(function (row) {
                    row.style.display =
                        row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>
