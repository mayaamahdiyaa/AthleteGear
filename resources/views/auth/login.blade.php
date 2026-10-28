<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AthleteGear</title>

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

        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--cream);
        }

        .auth-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(420px, 0.85fr);
            min-height: 100vh;
        }

        /* Bagian branding di kiri */
        .brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .logo-mark {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--red);
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 25px;
            font-weight: 800;
            font-style: italic;
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
            padding: 70px 0;
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

        .brand-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 35px;
            margin-top: 42px;
        }

        .stat-number {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 29px;
            font-weight: 700;
        }

        .stat-label {
            margin-top: 3px;
            color: #AEB6BA;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
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

        /* Bagian form login di kanan */
        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 55px clamp(30px, 6vw, 90px);
            background: var(--cream);
        }

        .mobile-logo {
            display: none;
        }

        .form-heading {
            margin-bottom: 34px;
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
            margin-bottom: 22px;
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
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
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
            width: 100%;
            min-height: 50px;
            padding: 13px 15px 13px 45px;
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

        .field-error {
            margin-top: 7px;
            color: #C53030;
            font-size: 11px;
        }

        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 51px;
            margin-top: 7px;
            border: none;
            border-radius: 8px;
            background: var(--red);
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .submit-button:hover {
            background: var(--dark-red);
            transform: translateY(-1px);
        }

        .submit-button svg {
            width: 17px;
            height: 17px;
        }

        .form-bottom {
            margin-top: 28px;
            padding-top: 23px;
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
            margin-top: 28px;
            color: #899196;
            font-size: 10px;
        }

        .security-note svg {
            width: 14px;
            height: 14px;
        }

        @media (max-width: 900px) {
            .auth-layout {
                grid-template-columns: minmax(0, 0.9fr) minmax(380px, 1fr);
            }

            .brand-panel {
                padding: 32px;
            }

            .form-panel {
                padding: 45px 35px;
            }

            .brand-content h1 {
                font-size: 58px;
            }

            .brand-stats {
                gap: 20px;
            }
        }

        @media (max-width: 700px) {
            .auth-layout {
                display: block;
            }

            .brand-panel {
                display: none;
            }

            .form-panel {
                min-height: 100vh;
                padding: 35px 24px;
            }

            .mobile-logo {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 55px;
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
                padding: 28px 18px;
            }

            .mobile-logo {
                margin-bottom: 40px;
            }
        }
    </style>
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