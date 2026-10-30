<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/login.css'])
</head>
<body>
    <main class="auth-layout">

        <section class="brand-panel">
            <div class="brand-top">
                <div class="brand-logo">
                    <div class="logo-mark">AG</div>
                    <div>
                        <div class="logo-name">ATHLETEGEAR</div>
                        <div class="logo-caption">TRACK & FIELD MANAGEMENT</div>
                    </div>
                </div>
            </div>

            <div class="brand-content">
                <div class="eyebrow">Built for athletes</div>

                <h1>
                    Better Gear.<br>
                    Better <span>Performance.</span>
                </h1>

                <p>
                    Keep your equipment organized, manage borrowing records,
                    and stay ready for your next performance.
                </p>

                <div class="brand-stats">
                    <div>
                        <div class="stat-number">01</div>
                        <div class="stat-label">Stay Organized</div>
                    </div>

                    <div>
                        <div class="stat-number">02</div>
                        <div class="stat-label">Track Equipment</div>
                    </div>

                    <div>
                        <div class="stat-number">03</div>
                        <div class="stat-label">Perform Better</div>
                    </div>
                </div>
            </div>

            <div class="brand-footer">
                <span>ATHLETEGEAR <strong>© {{ date('Y') }}</strong></span>
                <span>READY. SET. PERFORM.</span>
            </div>
        </section>

        <section class="form-panel">
            <div class="mobile-logo">
                <div class="logo-mark">AG</div>
                <div>
                    <div class="logo-name">ATHLETEGEAR</div>
                    <div class="logo-caption">TRACK & FIELD MANAGEMENT</div>
                </div>
            </div>

            <div class="form-heading">
                <div class="form-kicker">Welcome back</div>
                <h2>Login to Your Account</h2>
                <p>Enter your account details to access AthleteGear.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>

                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="m3 7 9 6 9-6"></path>
                        </svg>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                            required
                            autofocus
                        >
                    </div>

                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="4" y="10" width="16" height="11" rx="2"></rect>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            <path d="M12 14v3"></path>
                        </svg>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="submit-button">
                    Login to AthleteGear

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>
            </form>

            <div class="form-bottom">
                Don't have an account?
                <a href="{{ route('register') }}">Create an account</a>
            </div>

            <div class="security-note">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>

                Secure access to your equipment management system
            </div>
        </section>

    </main>
</body>
</html>