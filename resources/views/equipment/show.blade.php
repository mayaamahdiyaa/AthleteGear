
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Details | AthleteGear</title>

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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        /* SIDEBAR */
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

        .brand-name span {
            color: var(--red);
        }

        .nav-label {
            padding: 0 12px;
            margin-bottom: 12px;
            color: #929BA1;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.8px;
        }

        .nav {
            display: grid;
            gap: 8px;
        }

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

        .nav-link:hover {
            background: #30363B;
        }

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

        /* MAIN AND TOPBAR */
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
            background: #FFFFFF;
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

        /* TRACK AND FIELD BANNER */
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
                    rgba(20, 25, 29, 0.72) 0%,
                    rgba(20, 25, 29, 0.40) 55%,
                    rgba(20, 25, 29, 0.15) 100%
                ),
                url("/images/Track%20Banner.jpg") center center / cover no-repeat;
        }

        .hero::after {
            content: "";
            position: absolute;
            z-index: -1;
            width: 75%;
            height: 180px;
            right: -15%;
            bottom: -125px;
            border-top: 3px solid rgba(255, 255, 255, .9);
            border-bottom: 3px solid rgba(255, 255, 255, .65);
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

        /* CONTENT */
        .content {
            padding: 25px 30px 40px;
        }

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

        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .section-eyebrow {
            margin: 0 0 6px;
            color: var(--red-dark);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
        }

        .section-title {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            text-transform: uppercase;
        }

        .section-description {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
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

        .button-primary:hover {
            background: var(--red-dark);
        }

        .button-dark {
            color: white;
            background: var(--charcoal);
        }

        .button-outline {
            color: var(--text);
            background: white;
            border-color: #D4DADD;
        }

        /* EQUIPMENT DETAIL */
        .detail-card {
            overflow: hidden;
            background: white;
            border: 1px solid #DFE3E3;
            border-radius: 8px;
        }

        .detail-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px;
            background: #F0F2F1;
            border-bottom: 1px solid var(--line);
        }

        .equipment-symbol {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 8px;
            background: var(--charcoal);
            color: white;
            font-size: 27px;
        }

        .equipment-heading {
            min-width: 0;
        }

        .equipment-heading h2 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 30px;
            font-weight: 800;
            line-height: 1.1;
            overflow-wrap: anywhere;
        }

        .equipment-heading p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .detail-body {
            padding: 24px 22px;
        }

        .detail-section-title {
            margin: 0 0 16px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .detail-item {
            min-width: 0;
            padding: 17px;
            border: 1px solid var(--line);
            border-radius: 6px;
            background: #FDFDFC;
        }

        .detail-label {
            display: block;
            margin-bottom: 9px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .detail-value {
            display: block;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .description-item {
            grid-column: 1 / -1;
        }

        .description-value {
            font-size: 12px;
            font-weight: 400;
            white-space: pre-line;
        }

        .category-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            color: #526775;
            background: #EAF0F2;
            font-size: 10px;
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .status-available {
            color: #28794E;
            background: #D9F0E1;
        }

        .status-low {
            color: #A85B00;
            background: #FFEBC5;
        }

        .status-out {
            color: #B52C35;
            background: #FFE0E1;
        }

        .condition {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            color: #28794E;
            background: #D9F0E1;
            font-size: 10px;
            font-weight: 700;
        }

        .condition-fair {
            color: #865900;
            background: #FFEBC5;
        }

        .condition-poor {
            color: #B52C35;
            background: #FFE0E1;
        }

        .detail-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 17px 22px;
            border-top: 1px solid var(--line);
            background: #FDFDFC;
        }

        .created-info {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .detail-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .page-footer {
            padding-top: 22px;
            color: #899198;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .sidebar {
                width: 205px;
            }

            .main {
                margin-left: 205px;
            }

            .content {
                padding: 22px 18px 35px;
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 13px 15px;
            }

            .brand {
                padding: 0 0 13px;
            }

            .nav-label,
            .sidebar-bottom {
                display: none;
            }

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

            .main {
                margin-left: 0;
            }

            .topbar {
                min-height: 60px;
                padding: 12px 15px;
            }

            .topbar-title {
                display: none;
            }

            .user-area {
                gap: 8px;
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
                background-position: center center;
            }

            .hero h1 {
                font-size: clamp(38px, 9vw, 54px);
            }

            .hero-note {
                display: none;
            }

            .content {
                padding: 18px 12px 28px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .detail-card-header {
                padding: 17px;
            }

            .detail-body {
                padding: 18px 15px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .description-item {
                grid-column: auto;
            }

            .detail-footer {
                align-items: flex-start;
                flex-direction: column;
                padding: 16px;
            }

            .detail-actions {
                width: 100%;
            }

            .detail-actions .button {
                flex: 1;
            }
        }
    </style>
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

    <aside class="sidebar">
        <a href="{{ route('equipment.index') }}" class="brand" aria-label="AthleteGear home">
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
            <a href="{{ route('equipment.index') }}" class="nav-link active">
                <span class="nav-icon">▤</span>
                Equipment
            </a>

            @if ($isAdmin)
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <span class="nav-icon">▦</span>
                    Categories
                </a>
            @endif

            <a href="{{ route('borrowings.index') }}" class="nav-link">
                <span class="nav-icon">◷</span>
                Borrowings
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
