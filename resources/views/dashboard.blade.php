<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --red: #D94343;
            --red-dark: #B92E35;
            --charcoal: #202428;
            --cream: #F7F6F2;
            --green: #487A59;
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
        button { font: inherit; }

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
        .nav-link.active { background: var(--red); color: white; }
        .nav-icon { width: 22px; text-align: center; font-size: 19px; }

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

        .topbar-title { color: var(--muted); font-size: 12px; }

        .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: white;
            background: var(--charcoal);
            font-weight: 700;
        }

        .user-info strong { display: block; font-size: 12px; }

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

        /* Banner dibuat sama seperti halaman Equipment:
           berada langsung di bawah topbar dan memenuhi lebar main. */
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
                linear-gradient(90deg, rgba(20,25,29,.78), rgba(20,25,29,.25)),
                url("/images/Track%20Banner.jpg") center / cover no-repeat,
                var(--charcoal);
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
            min-width: 0;
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
            line-height: 1.7;
        }

        .hero-note {
            position: relative;
            z-index: 1;
            max-width: 180px;
            flex-shrink: 0;
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

        /* Padding hanya berlaku untuk isi dashboard, bukan banner. */
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

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 28px 0 15px;
        }

        .section-heading h2 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 27px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .section-heading a {
            color: var(--red-dark);
            font-size: 12px;
            font-weight: 700;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .stat-card {
            min-width: 0;
            padding: 20px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 8px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 8px;
            color: var(--red-dark);
            background: #FBE8E6;
            font-weight: 800;
            font-size: 11px;
        }

        .stat-value {
            margin-top: 15px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 38px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .stat-note {
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
        }

        .panel {
            min-width: 0;
            overflow: hidden;
            background: white;
            border: 1px solid #DFE3E3;
            border-radius: 8px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
        }

        .panel-header h3 { margin: 0; font-size: 13px; }

        .panel-header a {
            color: var(--red-dark);
            font-size: 11px;
            font-weight: 700;
        }

        .table-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 15px 12px;
            color: #35414A;
            background: #F0F2F1;
            border-bottom: 1px solid var(--line);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 13px 12px;
            border-bottom: 1px solid #E8EAE9;
            font-size: 12px;
            vertical-align: middle;
        }

        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #FCFBF8; }
        td:first-child { font-weight: 600; }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-borrowed { background: #FFF0D7; color: #8A5A12; }
        .badge-pending { background: #FBE6E4; color: #A72E32; }
        .badge-returned { background: #E4F2E7; color: #356447; }
        .badge-other { background: #ECEFF1; color: #53616A; }

        .lower-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(250px, 1fr);
            gap: 18px;
            margin-top: 22px;
        }

        .stock-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 15px 20px;
            border-bottom: 1px solid #EFF0EE;
            font-size: 12px;
        }

        .stock-item:last-child { border-bottom: 0; }
        .stock-name { font-weight: 700; overflow-wrap: anywhere; }
        .stock-category { margin-top: 5px; color: var(--muted); font-size: 10px; }
        .stock-number { flex-shrink: 0; color: var(--red-dark); font-weight: 700; }

        .empty {
            padding: 28px 20px;
            color: var(--muted);
            text-align: center;
            font-size: 12px;
            line-height: 1.7;
        }

        .quick-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--red-dark);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .footer {
            padding-top: 25px;
            color: #899198;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .sidebar { width: 205px; }
            .main { margin-left: 205px; }
            .content { padding: 22px 18px 35px; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .lower-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 13px 15px;
            }

            .brand { padding: 0 0 13px; }
            .nav-label, .sidebar-bottom { display: none; }
            .nav { display: flex; gap: 6px; overflow-x: auto; }

            .nav-link {
                flex-shrink: 0;
                gap: 7px;
                padding: 10px 12px;
                font-size: 11px;
            }

            .main { margin-left: 0; }
            .topbar { min-height: 60px; padding: 12px 15px; }
            .topbar-title { display: none; }
            .user-area { gap: 8px; }
            .avatar { width: 32px; height: 32px; }
            .logout-form { margin-left: 4px; padding-left: 10px; }

            /* Ukuran banner mengikuti Equipment pada tampilan mobile. */
            .hero {
                min-height: 190px;
                padding: 27px 20px;
            }

            .hero h1 { font-size: clamp(38px, 9vw, 54px); }
            .hero-note { display: none; }
            .content { padding: 18px 12px 28px; }
            .stats { gap: 10px; }
            .stat-card { padding: 14px; }
            .stat-icon { width: 30px; height: 30px; }
            .stat-value { font-size: 32px; }
            .stat-label, .stat-note { font-size: 10px; }
            .section-heading h2 { font-size: 23px; }
            .panel-header { padding: 15px; }
            th, td { padding: 12px; }
        }

        @media (max-width: 360px) {
            .stats { grid-template-columns: 1fr; }
            .topbar { flex-wrap: wrap; }
            .hero h1 { font-size: 36px; }
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
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <span class="nav-icon">⌂</span> Dashboard
            </a>

            <a href="{{ route('equipment.index') }}" class="nav-link">
                <span class="nav-icon">▤</span> Equipment
            </a>

            @if ($isAdmin)
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <span class="nav-icon">▦</span> Categories
                </a>
            @endif

            <a href="{{ route('borrowings.index') }}" class="nav-link">
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
            <div class="topbar-title">ATHLETEGEAR / PERFORMANCE DASHBOARD</div>

            <div class="user-area">
                <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>

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

        {{-- Banner sekarang berada di luar .content agar lebarnya sama seperti Equipment. --}}
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
