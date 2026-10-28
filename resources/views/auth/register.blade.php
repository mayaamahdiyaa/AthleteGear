<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --red: #D94343;
            --dark-red: #B92E35;
            --charcoal: #202428;
            --cream: #F7F6F2;
            --text: #26323A;
            --muted: #74808A;
            --line: #E4E6E4;
            --green: #487A59;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--cream);
        }

        .auth-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(440px, 0.85fr);
            min-height: 100vh;
        }

        /* Panel branding AthleteGear */
        .brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            padding: 38px 48px;
            overflow: hidden;
            color: white;
            background:
                linear-gradient(145deg, rgba(32, 36, 40, 0.96), rgba(32, 36, 40, 0.82)),
                url("/images/Track%20Banner.jpg") center / cover no-repeat;
        }

        .brand-panel::before,
        .brand-panel::after {
            position: absolute;
            content: "";
            pointer-events: none;
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 50%;
            transform: rotate(-25deg);
        }

        .brand-panel::before {
            width: 650px;
            height: 900px;
            right: -320px;
            top: -180px;
        }

        .brand-panel::after {
            width: 520px;
            height: 760px;
            right: -250px;
            top: -100px;
        }

        .brand-top,
        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 1;
        }

        .brand-logo,
        .mobile-logo {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .logo-mark {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border-radius: 10px;
            background: var(--red);
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 25px;
            font-weight: 800;
            font-style: italic;
            color: white;
        }

        .logo-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 29px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: 0.5px;
        }

        .logo-caption {
            margin-top: 5px;
            color: #B8BEC2;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .brand-content {
            max-width: 570px;
            padding: 55px 0;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 24px;
            color: #F08A8A;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            width: 26px;
            height: 2px;
            content: "";
            background: var(--red);
        }

        .brand-content h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(52px, 6vw, 86px);
            font-weight: 800;
            font-style: italic;
            line-height: 0.95;
            text-transform: uppercase;
        }

        .brand-content h1 span {
            color: var(--red);
        }

        .brand-content p {
            max-width: 390px;
            margin-top: 25px;
            color: #C1C7CA;
            font-size: 14px;
            line-height: 1.9;
        }

        .benefit-list {
            display: grid;
            gap: 18px;
            margin-top: 35px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #D7DCDE;
            font-size: 12px;
        }

        .benefit-check {
            display: grid;
            place-items: center;
            width: 25px;
            height: 25px;
            flex-shrink: 0;
            border: 1px solid rgba(217, 67, 67, 0.5);
            border-radius: 7px;
            color: #F08A8A;
            font-size: 13px;
            font-weight: 700;
        }

        .brand-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            color: #AEB6BA;
            font-size: 10px;
            letter-spacing: 1px;
        }

        .brand-footer strong {
            color: white;
            font-weight: 600;
        }

        /* Panel form register */
        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            min-height: 100vh;
            padding: 40px clamp(30px, 5.5vw, 80px);
            background: var(--cream);
        }

        .mobile-logo {
            display: none;
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .form-kicker {
            margin-bottom: 10px;
            color: var(--red);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .form-heading h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 43px;
            font-weight: 700;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .form-heading p {
            margin-top: 10px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert-success {
            color: var(--green);
            border-color: #C9DECE;
            background: #EDF5EF;
        }

        .alert-error {
            color: #B92E35;
            border-color: #F0C8C8;
            background: #FFF0F0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            width: 18px;
            height: 18px;
            color: #929BA0;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 48px;
            padding: 12px 15px 12px 45px;
            border: 1px solid var(--line);
            border-radius: 8px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(217, 67, 67, 0.10);
        }

        .form-control::placeholder {
            color: #A0A8AC;
        }

        .field-hint {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .field-error {
            margin-top: 7px;
            color: #C53030;
            font-size: 11px;
            line-height: 1.5;
        }

        /* Tombol submit dibuat jelas dan tidak disembunyikan */
        .submit-button {
            display: flex;
            position: relative;
            z-index: 2;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 50px;
            margin-top: 8px;
            padding: 14px 18px;
            border: none;
            border-radius: 8px;
            background: var(--red);
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            visibility: visible;
            opacity: 1;
            transition: background 0.2s, transform 0.2s;
        }

        .submit-button:hover {
            background: var(--dark-red);
            transform: translateY(-1px);
        }

        .submit-button:focus-visible {
            outline: 3px solid rgba(217, 67, 67, 0.3);
            outline-offset: 3px;
        }

        .submit-button svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        .form-bottom {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        .form-bottom a {
            color: var(--red);
            font-weight: 700;
            text-decoration: none;
        }

        .form-bottom a:hover {
            color: var(--dark-red);
            text-decoration: underline;
        }

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 22px;
            color: #899196;
            font-size: 10px;
            line-height: 1.6;
            text-align: center;
        }

        .security-note svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        /* Kalau layar pendek, halaman tetap bisa di-scroll */
        @media (max-height: 850px) and (min-width: 761px) {
            .form-panel {
                justify-content: flex-start;
                padding-top: 28px;
                padding-bottom: 28px;
            }

            .form-heading {
                margin-bottom: 22px;
            }

            .form-group {
                margin-bottom: 14px;
            }

            .form-bottom {
                margin-top: 20px;
                padding-top: 17px;
            }
        }

        @media (max-width: 1000px) {
            .auth-layout {
                grid-template-columns: minmax(0, 0.85fr) minmax(400px, 1fr);
            }

            .brand-panel {
                padding: 32px;
            }

            .form-panel {
                padding-right: 32px;
                padding-left: 32px;
            }

            .brand-content h1 {
                font-size: 58px;
            }
        }

        @media (max-width: 760px) {
            .auth-layout {
                display: block;
            }

            .brand-panel {
                display: none;
            }

            .form-panel {
                display: flex;
                justify-content: flex-start;
                min-height: 100vh;
                padding: 30px 24px;
                overflow: visible;
            }

            .mobile-logo {
                display: flex;
                margin-bottom: 35px;
            }

            .mobile-logo .logo-mark {
                width: 40px;
                height: 40px;
                font-size: 23px;
            }

            .mobile-logo .logo-name {
                color: var(--charcoal);
                font-size: 27px;
            }

            .mobile-logo .logo-caption {
                color: var(--muted);
            }

            .form-heading h2 {
                font-size: 39px;
            }
        }

        @media (max-width: 380px) {
            .form-panel {
                padding: 25px 18px;
            }

            .form-heading h2 {
                font-size: 35px;
            }
        }
    </style>
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