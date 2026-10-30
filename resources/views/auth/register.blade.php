<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/register.css'])
</head>
<body>
    <main class="auth-layout">

        <!-- Branding panel -->
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
                <div class="eyebrow">Start your journey</div>

                <h1>
                    Gear Up.<br>
                    <span>Level Up.</span>
                </h1>

                <p>
                    Create your account and get ready to manage your
                    track and field equipment in one place.
                </p>

                <div class="benefit-list">
                    <div class="benefit-item">
                        <span class="benefit-check">✓</span>
                        Keep equipment records organized
                    </div>

                    <div class="benefit-item">
                        <span class="benefit-check">✓</span>
                        Manage your borrowing history
                    </div>

                    <div class="benefit-item">
                        <span class="benefit-check">✓</span>
                        Stay ready for your next performance
                    </div>
                </div>
            </div>

            <div class="brand-footer">
                <span>ATHLETEGEAR <strong>© {{ date('Y') }}</strong></span>
                <span>READY. SET. PERFORM.</span>
            </div>
        </section>

        <!-- Register form -->
        <section class="form-panel">
            <div class="mobile-logo">
                <div class="logo-mark">AG</div>

                <div>
                    <div class="logo-name">ATHLETEGEAR</div>
                    <div class="logo-caption">TRACK & FIELD MANAGEMENT</div>
                </div>
            </div>

            <div class="form-heading">
                <div class="form-kicker">Join AthleteGear</div>
                <h2>Create Account</h2>
                <p>Fill in your details to get started.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    Please check the highlighted fields and try again.
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>

                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M5 21v-2a7 7 0 0 1 14 0v2"></path>
                        </svg>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            maxlength="100"
                            autocomplete="name"
                            required
                            autofocus
                        >
                    </div>

                    @error('name')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

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
                            maxlength="255"
                            autocomplete="email"
                            required
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
                            placeholder="Create a password"
                            minlength="8"
                            autocomplete="new-password"
                            required
                        >
                    </div>

                    <p class="field-hint">Use at least 8 characters.</p>

                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>

                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="4" y="10" width="16" height="11" rx="2"></rect>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            <path d="m9 15 2 2 4-4"></path>
                        </svg>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Re-enter your password"
                            minlength="8"
                            autocomplete="new-password"
                            required
                        >
                    </div>

                    @error('password_confirmation')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol untuk mengirim form register -->
                <button type="submit" class="submit-button">
                    <span>Create My Account</span>

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>
            </form>

            <div class="form-bottom">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

            <div class="security-note">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>

                Your account details are handled securely
            </div>
        </section>

    </main>
</body>
</html>