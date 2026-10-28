
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            padding: 10px 15px;
            border: 1px solid var(--line);
            border-radius: 6px;
            background: white;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            transition: .2s ease;
        }

        .back-button:hover {
            color: var(--red-dark);
            border-color: var(--red);
            transform: translateY(-1px);
        }

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

        .runner-logo { width: 43px; height: 43px; flex-shrink: 0; }

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
        }

        .nav-link:hover { background: #30363B; }
        .nav-link.active { background: var(--red); color: white; }
        .nav-icon { width: 22px; text-align: center; font-size: 19px; }

        .sidebar-bottom { margin-top: auto; padding: 30px 10px 0; }

        .lane-decoration {
            height: 80px;
            margin-bottom: 18px;
            overflow: hidden;
            transform: skewY(-7deg);
            border-top: 2px solid #FFFFFF55;
            border-bottom: 2px solid #FFFFFF55;
            background: repeating-linear-gradient(
                105deg, transparent 0, transparent 31px,
                #FFFFFF24 32px, #FFFFFF24 34px
            );
        }

        .sidebar-bottom strong {
            display: block;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 21px;
            font-style: italic;
            line-height: 1.05;
        }

        .sidebar-bottom p { color: #AEB5B8; font-size: 11px; line-height: 1.6; }

        .main { min-height: 100vh; margin-left: 238px; }

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

        .user-area { display: flex; align-items: center; gap: 12px; }

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
        .user-info span { color: var(--muted); font-size: 11px; text-transform: capitalize; }

        .logout-form { margin-left: 15px; padding-left: 18px; border-left: 1px solid var(--line); }

        .logout-button {
            border: 0;
            background: transparent;
            color: var(--red-dark);
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .hero {
            min-height: 190px;
            display: flex;
            align-items: center;
            padding: 30px 38px;
            color: white;
            background:
                linear-gradient(90deg, rgba(20,25,29,.82), rgba(20,25,29,.25)),
                url("/images/Track%20Banner.jpg") center / cover no-repeat,
                var(--charcoal);
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
            font-size: clamp(42px, 5vw, 60px);
            font-weight: 900;
            font-style: italic;
            line-height: .95;
            text-transform: uppercase;
        }

        .hero p:last-child { margin-bottom: 0; font-size: 13px; line-height: 1.7; }

        .content { padding: 28px 30px 40px; }

        .flash {
            padding: 13px 15px;
            margin-bottom: 18px;
            border: 1px solid;
            border-radius: 6px;
            font-size: 12px;
        }

        .flash.success { color: #286746; background: #EDF7F0; border-color: #CBE4D2; }
        .flash.error { color: #A72C35; background: #FFF0F0; border-color: #F0CACA; }

        .profile-card {
            max-width: 760px;
            overflow: hidden;
            background: white;
            border: 1px solid var(--line);
            border-radius: 9px;
        }

        .card-heading { padding: 22px 25px; border-bottom: 1px solid var(--line); }

        .card-heading h2 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 27px;
            text-transform: uppercase;
        }

        .card-heading p { margin: 5px 0 0; color: var(--muted); font-size: 12px; }

        .profile-body { padding: 25px; }

        .profile-summary {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 24px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--line);
        }

        .profile-avatar {
            width: 64px;
            height: 64px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 50%;
            color: white;
            background: var(--charcoal);
            font-size: 25px;
            font-weight: 800;
        }

        .profile-summary h3 { margin: 0 0 5px; font-size: 17px; }
        .profile-summary p { margin: 0; color: var(--muted); font-size: 12px; }

        .role-badge {
            display: inline-block;
            margin-top: 8px;
            padding: 5px 10px;
            border-radius: 20px;
            color: var(--red-dark);
            background: #FBE8E6;
            font-size: 10px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .form-grid { display: grid; gap: 18px; }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #D9DEDE;
            border-radius: 6px;
            outline: none;
            font-size: 13px;
        }

        .form-group input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px #D943431A;
        }

        .field-error { margin-top: 6px; color: #A72C35; font-size: 11px; }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .save-button {
            padding: 12px 18px;
            border: 0;
            border-radius: 6px;
            color: white;
            background: var(--red);
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .save-button:hover { background: var(--red-dark); }

        .footer {
            padding-top: 25px;
            color: #899198;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .sidebar { width: 205px; }
            .main { margin-left: 205px; }
        }

        @media (max-width: 760px) {
            .sidebar { position: static; width: 100%; padding: 13px 15px; }
            .brand { padding: 0 0 13px; }
            .nav-label, .sidebar-bottom { display: none; }
            .nav { display: flex; gap: 6px; overflow-x: auto; }
            .nav-link { flex-shrink: 0; gap: 7px; padding: 10px 12px; font-size: 11px; }
            .main { margin-left: 0; }
            .topbar { min-height: 60px; padding: 12px 15px; }
            .topbar-title { display: none; }
            .user-area { gap: 8px; }
            .avatar { width: 32px; height: 32px; }
            .logout-form { margin-left: 4px; padding-left: 10px; }
            .hero { min-height: 160px; padding: 25px 20px; }
            .content { padding: 20px 12px 28px; }
            .profile-body { padding: 18px; }
            .card-heading { padding: 18px; }
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
            <a href="{{ route('dashboard') }}" class="nav-link">
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
            <div class="topbar-title">ATHLETEGEAR / MY PROFILE</div>

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

        <section class="hero">
            <div>
                <p class="eyebrow">ATHLETEGEAR / ACCOUNT MANAGEMENT</p>
                <h1>My Profile.</h1>
                <p>Manage your account information and keep it up to date.</p>
            </div>
        </section>

        <div class="content">

            <a href="{{ route('dashboard') }}" class="back-button">
                <span aria-hidden="true">&larr;</span>
                Back to Dashboard
            </a>

            @if (session('success'))
                <div class="flash success" role="status">✓ {{ session('success') }}</div>
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

            <section class="profile-card">
                <div class="card-heading">
                    <h2>Account Information</h2>
                    <p>Update your name and email address below.</p>
                </div>

                <div class="profile-body">
                    <div class="profile-summary">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->email }}</p>
                            <span class="role-badge">{{ $user->role }}</span>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    maxlength="255"
                                    required
                                >
                                @error('name')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    maxlength="255"
                                    required
                                >
                                @error('email')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="save-button">Save Changes</button>
                        </div>
                    </form>
                </div>
            </section>

            <footer class="footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </div>
    </main>
</body>
</html>
