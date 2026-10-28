<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --red: #D94343;
            --red-dark: #B92E35;
            --charcoal: #202428;
            --cream: #F7F6F2;
            --text: #26323A;
            --muted: #74808A;
            --line: #E4E6E4;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 10;
            width: 238px;
            display: flex;
            flex-direction: column;
            padding: 24px 12px 20px;
            overflow-y: auto;
            color: white;
            background: var(--charcoal);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 8px 35px;
        }

        .runner-logo {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 29px;
            font-weight: 900;
            font-style: italic;
            letter-spacing: -1px;
            white-space: nowrap;
        }

        .brand-name span { color: var(--red); }

        .nav-label {
            padding: 0 12px;
            margin-bottom: 12px;
            color: #929BA1;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.8px;
        }

        .nav { display: grid; gap: 8px; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 13px;
            border-radius: 7px;
            color: #E0E3E5;
            font-size: 13px;
            font-weight: 600;
            transition: background .2s;
        }

        .nav-link:hover { background: #30363B; }

        .nav-link.active {
            background: var(--red);
            color: white;
        }

        .nav-icon {
            width: 22px;
            text-align: center;
            font-size: 19px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 30px 10px 0;
        }

        .lane-decoration {
            height: 80px;
            margin-bottom: 18px;
            overflow: hidden;
            transform: skewY(-7deg);
            border-top: 2px solid #FFFFFF55;
            border-bottom: 2px solid #FFFFFF55;
            background: repeating-linear-gradient(
                105deg,
                transparent 0,
                transparent 31px,
                #FFFFFF24 32px,
                #FFFFFF24 34px
            );
        }

        .sidebar-bottom strong {
            display: block;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 21px;
            font-style: italic;
            line-height: 1.05;
        }

        .sidebar-bottom p {
            color: #AEB5B8;
            font-size: 11px;
            line-height: 1.6;
        }

        .main {
            min-height: 100vh;
            margin-left: 238px;
        }

        .topbar {
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 30px;
            background: white;
            border-bottom: 1px solid var(--line);
        }

        .topbar-title {
            color: var(--muted);
            font-size: 12px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Avatar dan nama user dapat diklik untuk membuka Profile */
        .profile-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 8px;
            border-radius: 8px;
            color: inherit;
            text-decoration: none;
            transition: background .2s;
        }

        .profile-link:hover { background: #F0F2F1; }

        .profile-link:hover .user-info strong {
            color: var(--red-dark);
        }

        .profile-link:focus-visible {
            outline: 2px solid var(--red);
            outline-offset: 3px;
        }

        .avatar {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 50%;
            color: white;
            background: var(--charcoal);
            font-weight: 700;
        }

        .user-info strong {
            display: block;
            font-size: 12px;
        }

        .user-info span {
            color: var(--muted);
            font-size: 11px;
            text-transform: capitalize;
        }

        .logout-form {
            margin-left: 15px;
            padding-left: 18px;
            border-left: 1px solid var(--line);
        }

        .logout-button {
            border: 0;
            background: transparent;
            color: var(--red-dark);
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .hero {
            position: relative;
            isolation: isolate;
            min-height: 230px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            overflow: hidden;
            padding: 35px 38px;
            color: white;
            background:
                linear-gradient(
                    90deg,
                    rgba(20,25,29,.72),
                    rgba(20,25,29,.40) 55%,
                    rgba(20,25,29,.15)
                ),
                url("/images/Track%20Banner.jpg") center / cover no-repeat;
        }

        .hero::after {
            content: "";
            position: absolute;
            z-index: -1;
            width: 75%;
            height: 180px;
            right: -15%;
            bottom: -125px;
            border-top: 3px solid #FFFFFFE6;
            border-bottom: 3px solid #FFFFFFA6;
            transform: rotate(-9deg);
            pointer-events: none;
        }

        .hero-copy {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: #FF6969;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .hero h1 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(42px, 5vw, 64px);
            font-weight: 900;
            font-style: italic;
            line-height: .92;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .hero-subtitle {
            margin: 14px 0 0;
            font-size: 14px;
        }

        .hero-note {
            position: relative;
            z-index: 1;
            max-width: 180px;
            text-align: right;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 17px;
            font-weight: 700;
            font-style: italic;
            line-height: 1.5;
            letter-spacing: 2px;
        }

        .hero-note span {
            display: block;
            width: 42px;
            height: 4px;
            margin: 14px 0 0 auto;
            background: var(--red);
        }

        .content { padding: 25px 30px 40px; }

        .flash {
            padding: 13px 15px;
            margin-bottom: 18px;
            border: 1px solid;
            border-radius: 6px;
            font-size: 12px;
            line-height: 1.5;
        }

        .flash.success {
            color: #286746;
            background: #EDF7F0;
            border-color: #CBE4D2;
        }

        .flash.error {
            color: #A72C35;
            background: #FFF0F0;
            border-color: #F0CACA;
        }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .search-form { width: min(100%, 590px); }

        .search-input {
            width: 100%;
            min-height: 43px;
            padding: 12px 15px;
            border: 1px solid #D8DDDF;
            border-radius: 6px;
            outline: none;
            background: white;
            color: var(--text);
            font-size: 12px;
        }

        .search-input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px #D943431C;
        }

        .button {
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 12px;
            border: 1px solid transparent;
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .button-primary {
            color: white;
            background: var(--red);
        }

        .button-primary:hover { background: var(--red-dark); }

        .button-outline {
            color: var(--text);
            background: white;
            border-color: #D4DADD;
        }

        .button-danger {
            color: #C5323B;
            background: white;
            border-color: #EFC2C5;
        }

        .admin-note {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 10px;
            text-align: right;
        }

        .table-card {
            overflow: hidden;
            background: white;
            border: 1px solid #DFE3E3;
            border-radius: 8px;
        }

        .table-scroll { overflow-x: auto; }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 12px;
        }

        .inventory-table th {
            padding: 15px 12px;
            color: #35414A;
            background: #F0F2F1;
            border-bottom: 1px solid var(--line);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .inventory-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #E8EAE9;
            vertical-align: middle;
        }

        .inventory-table tbody tr:last-child td { border-bottom: 0; }
        .inventory-table tbody tr:hover { background: #FCFBF8; }

        .number-cell {
            color: #68747C;
            font-weight: 600;
        }

        .category-name {
            min-width: 150px;
            font-weight: 700;
        }

        .category-description {
            min-width: 180px;
            max-width: 420px;
            color: #68747C;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .category-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            color: #526775;
            background: #EAF0F2;
            font-size: 10px;
            white-space: nowrap;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .actions .button {
            min-height: 32px;
            padding: 7px 9px;
        }

        .delete-form {
            display: inline;
            margin: 0;
        }

        .table-footer {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            padding: 14px 16px;
            border-top: 1px solid var(--line);
            background: #FDFDFC;
        }

        .legend {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #68747C;
            font-size: 10px;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 12px;
            font-size: 38px;
        }

        .empty-state h2 {
            margin: 0 0 8px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            text-transform: uppercase;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 13px;
        }

        .page-footer {
            padding-top: 22px;
            color: #899198;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .sidebar { width: 205px; }
            .main { margin-left: 205px; }
            .content { padding: 22px 18px 35px; }
            .inventory-table { min-width: 650px; }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 13px 15px;
            }

            .brand { padding: 0 0 13px; }
            .nav-label, .sidebar-bottom { display: none; }

            .nav {
                display: flex;
                gap: 6px;
                overflow-x: auto;
            }

            .nav-link {
                flex-shrink: 0;
                gap: 7px;
                padding: 10px 12px;
                font-size: 11px;
            }

            .main { margin-left: 0; }

            .topbar {
                min-height: 60px;
                padding: 12px 15px;
            }

            .topbar-title { display: none; }
            .user-area { gap: 8px; }

            .profile-link {
                gap: 8px;
                padding: 4px;
            }

            .avatar {
                width: 32px;
                height: 32px;
            }

            .logout-form {
                margin-left: 4px;
                padding-left: 10px;
            }

            .hero {
                min-height: 190px;
                padding: 27px 20px;
            }

            .hero h1 { font-size: clamp(38px, 9vw, 54px); }
            .hero-note { display: none; }
            .content { padding: 18px 12px 28px; }

            .toolbar {
                align-items: stretch;
                flex-direction: column;
                gap: 12px;
                margin-bottom: 17px;
            }

            .search-form { width: 100%; }
            .toolbar-action { align-self: flex-start; }
            .admin-note { text-align: left; }
        }

        @media (max-width: 360px) {
            .topbar { flex-wrap: wrap; }
            .user-info strong { font-size: 11px; }
            .user-info span { font-size: 10px; }
        }
    </style>
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="brand" aria-label="AthleteGear Dashboard">
            <svg class="runner-logo" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="43" cy="10" r="6" fill="white"/>
                <path d="M35 19L25 29L37 35L45 25L53 30" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25 29L15 24L8 31" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M37 35L27 46L13 52" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M37 35L46 44L57 46" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M30 21L42 18" stroke="#D94343" stroke-width="4" stroke-linecap="round"/>
            </svg>
            <span class="brand-name">Athlete<span>Gear</span></span>
        </a>

        <div class="nav-label">WORKSPACE</div>

        <nav class="nav" aria-label="Main navigation">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">▦</span> Dashboard
            </a>

            <a href="{{ route('equipment.index') }}"
               class="nav-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}">
                <span class="nav-icon">▤</span> Equipment
            </a>

            @if ($isAdmin)
                <a href="{{ route('categories.index') }}"
                   class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <span class="nav-icon">▧</span> Categories
                </a>
            @endif

            <a href="{{ route('borrowings.index') }}"
               class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
                <span class="nav-icon">◷</span> Borrowings
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="lane-decoration"></div>
            <strong>BETTER GEAR.<br>BETTER PERFORMANCE.</strong>
            <p>Built for athletes. Ready for every training session.</p>
        </div>
    </aside>

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
