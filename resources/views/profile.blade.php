
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/shared.css', 'resources/css/pages/profile.css'])


</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <x-sidebar />

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
