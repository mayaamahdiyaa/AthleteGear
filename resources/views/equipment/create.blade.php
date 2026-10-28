
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Equipment - AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,600;0,700;0,800;1,600;1,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input, select, textarea {
            font: inherit;
        }

        .layout {
            min-height: 100vh;
        }

        .sidebar {
            width: 238px;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 10;
            display: flex;
            flex-direction: column;
            padding: 28px 20px;
            background: var(--charcoal);
            color: var(--white);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 4px 30px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            background: var(--red);
            border-radius: 10px;
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .brand-subtitle {
            margin-top: 2px;
            color: #AAB0B5;
            font-size: 9px;
            letter-spacing: 1.2px;
        }

        .nav-label {
            padding: 0 12px;
            margin-bottom: 12px;
            color: #858D93;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 12px;
            border-radius: 8px;
            color: #C5C9CC;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .nav a:hover,
        .nav a.active {
            background: var(--red);
            color: var(--white);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 20px 5px 0;
        }

        .lane-decoration {
            height: 35px;
            margin-bottom: 17px;
            border-top: 2px solid #545A5F;
            border-bottom: 2px solid #545A5F;
            position: relative;
        }

        .lane-decoration::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            border-top: 2px dashed #777D82;
        }

        .sidebar-tagline {
            color: #AAB0B5;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 19px;
            font-weight: 700;
            line-height: 1.2;
        }

        .sidebar-tagline span {
            color: var(--red);
        }

        .main {
            margin-left: 238px;
            min-height: 100vh;
        }

        .topbar {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
            padding: 15px 38px;
            background: var(--white);
            border-bottom: 1px solid var(--line);
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 12px;
            font-weight: 700;
        }

        .user-role {
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
            text-transform: capitalize;
        }

        .avatar {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #F8E5E5;
            color: var(--red-dark);
            font-weight: 700;
            font-size: 13px;
        }

        .logout-form {
            margin-left: 4px;
        }

        .logout-button {
            padding: 9px 12px;
            border: 1px solid var(--line);
            border-radius: 7px;
            background: var(--white);
            color: var(--text);
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
        }

        .logout-button:hover {
            border-color: var(--red);
            color: var(--red-dark);
        }

        .hero {
            min-height: 220px;
            display: flex;
            align-items: center;
            padding: 36px 48px;
            color: var(--white);
            background:
                linear-gradient(90deg, rgba(24, 29, 33, .94), rgba(24, 29, 33, .58)),
                url("/images/Track%20Banner.jpg") center 55% / cover;
        }

        .hero-content {
            max-width: 650px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 10px;
            color: #FF8585;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: '';
            width: 24px;
            height: 2px;
            background: var(--red);
        }

        .hero h1 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(38px, 4vw, 54px);
            font-style: italic;
            font-weight: 800;
            line-height: 1;
            text-transform: uppercase;
        }

        .hero p {
            margin: 13px 0 0;
            color: #D0D4D6;
            font-size: 12px;
            line-height: 1.7;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 38px 50px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 23px;
            color: var(--muted);
            font-size: 11px;
        }

        .breadcrumb a:hover {
            color: var(--red-dark);
        }

        .breadcrumb .current {
            color: var(--text);
            font-weight: 700;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 25px;
        }

        .section-kicker {
            margin-bottom: 7px;
            color: var(--red-dark);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .page-heading h2 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 34px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .page-heading p {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 11px 17px;
            border: 0;
            border-radius: 7px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            transition: .2s;
        }

        .button-primary {
            background: var(--red);
            color: var(--white);
        }

        .button-primary:hover {
            background: var(--red-dark);
            transform: translateY(-1px);
        }

        .button-secondary {
            background: var(--white);
            border: 1px solid var(--line);
            color: var(--text);
        }

        .button-secondary:hover {
            border-color: var(--red);
            color: var(--red-dark);
        }

        .form-card {
            max-width: 850px;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--white);
            box-shadow: 0 5px 20px rgba(32, 36, 40, .035);
        }

        .form-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px 26px;
            border-bottom: 1px solid var(--line);
        }

        .form-icon {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: #FBEAEA;
            color: var(--red-dark);
            font-size: 22px;
        }

        .form-card-header h3 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
        }

        .form-card-header p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .form-body {
            padding: 27px 26px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 20px;
        }

        .field {
            min-width: 0;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            display: block;
            margin-bottom: 9px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: var(--red);
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            min-height: 44px;
            padding: 12px 13px;
            border: 1px solid #D9DEDE;
            border-radius: 7px;
            outline: none;
            background: #FCFCFB;
            color: var(--text);
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s;
        }

        .field textarea {
            min-height: 105px;
            resize: vertical;
            line-height: 1.7;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(217, 67, 67, .1);
            background: var(--white);
        }

        .field input::placeholder,
        .field textarea::placeholder {
            color: #A4ACB1;
        }

        .field-hint {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .field-error {
            margin: 7px 0 0;
            color: #C62828;
            font-size: 11px;
            line-height: 1.5;
        }

        .input-invalid {
            border-color: #D94343 !important;
            background: #FFF9F9 !important;
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            padding: 20px 26px;
            border-top: 1px solid var(--line);
            background: #FCFCFB;
        }

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
            padding: 16px 18px;
            border: 1px solid #F0D8A7;
            border-radius: 9px;
            background: #FFF9EC;
            color: #73551A;
            font-size: 12px;
            line-height: 1.7;
        }

        .notice strong {
            display: block;
            margin-bottom: 3px;
        }

        .notice a {
            color: var(--red-dark);
            font-weight: 700;
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 20px;
            padding: 14px 17px;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.7;
        }

        .alert-error {
            border: 1px solid #F0CACA;
            background: #FFF1F1;
            color: #A32626;
        }

        .footer-note {
            margin-top: 24px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .sidebar {
                width: 210px;
                padding-inline: 15px;
            }

            .main {
                margin-left: 210px;
            }

            .content {
                padding-inline: 25px;
            }

            .hero {
                padding-inline: 30px;
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 15px 18px;
            }

            .brand {
                padding-bottom: 15px;
            }

            .nav-label,
            .sidebar-bottom {
                display: none;
            }

            .nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .nav a {
                padding: 10px;
                font-size: 11px;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                min-height: 65px;
                padding: 12px 18px;
            }

            .hero {
                min-height: 175px;
                padding: 28px 22px;
            }

            .content {
                padding: 23px 16px 35px;
            }

            .page-heading {
                flex-direction: column;
                align-items: stretch;
            }

            .page-heading .button {
                align-self: flex-start;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .field.full {
                grid-column: auto;
            }

            .form-card-header,
            .form-body {
                padding: 20px 17px;
            }

            .form-footer {
                padding: 17px;
            }
        }

        @media (max-width: 420px) {
            .user-role {
                display: none;
            }

            .logout-button {
                padding: 8px;
            }

            .form-footer .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @php
        $currentUser = auth()->user();
        $isAdmin = $currentUser && $currentUser->isAdmin();
    @endphp

    <div class="layout">
        <aside class="sidebar">
            <a href="{{ route('equipment.index') }}" class="brand">
                <div class="brand-icon">
                    <svg width="27" height="27" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                        <path d="M4 22L11 10L16 18L21 8L28 22H4Z" stroke="white" stroke-width="2.5" stroke-linejoin="round"/>
                        <path d="M7 25H25" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <div class="brand-name">ATHLETEGEAR</div>
                    <div class="brand-subtitle">SPORTS EQUIPMENT</div>
                </div>
            </a>

            <div class="nav-label">MAIN MENU</div>

            <nav class="nav">
                <a href="{{ route('equipment.index') }}" class="active">
                    <span class="nav-icon">▦</span>
                    Equipment
                </a>

                @if ($isAdmin)
                    <a href="{{ route('categories.index') }}">
                        <span class="nav-icon">▤</span>
                        Categories
                    </a>
                @endif

                <a href="{{ route('borrowings.index') }}">
                    <span class="nav-icon">⇄</span>
                    Borrowings
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="lane-decoration"></div>
                <div class="sidebar-tagline">
                    BETTER GEAR.<br>
                    <span>BETTER PERFORMANCE.</span>
                </div>
            </div>
        </aside>

        <main class="main">
            <header class="topbar">
                <div class="user-info">
                    <div class="user-name">{{ $currentUser?->name ?? 'User' }}</div>
                    <div class="user-role">{{ $currentUser?->role ?? 'Athlete' }}</div>
                </div>

                <div class="avatar">
                    {{ strtoupper(substr($currentUser?->name ?? 'U', 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">Logout ↗</button>
                </form>
            </header>

            <section class="hero">
                <div class="hero-content">
                    <div class="eyebrow">Inventory Management</div>
                    <h1>Add New Equipment</h1>
                    <p>Register sports equipment and keep your inventory organized.</p>
                </div>
            </section>

            <section class="content">
                <div class="breadcrumb">
                    <a href="{{ route('equipment.index') }}">Equipment Inventory</a>
                    <span>/</span>
                    <span class="current">Add Equipment</span>
                </div>

                <div class="page-heading">
                    <div>
                        <div class="section-kicker">NEW INVENTORY ITEM</div>
                        <h2>Equipment Details</h2>
                        <p>Enter the equipment information below. Fields marked with <span class="required">*</span> are required.</p>
                    </div>

                    <a href="{{ route('equipment.index') }}" class="button button-secondary">
                        ← Back to Equipment
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Please check the following fields:</strong>
                        <ul style="margin: 7px 0 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($categories->isEmpty())
                    <div class="notice">
                        <span style="font-size: 22px;">ⓘ</span>
                        <div>
                            <strong>No categories available</strong>
                            You need to create a category before adding equipment.
                            @if ($isAdmin)
                                <a href="{{ route('categories.create') }}">Create a category →</a>
                            @endif
                        </div>
                    </div>
                @else
                    <form action="{{ route('equipment.store') }}" method="POST" class="form-card">
                        @csrf

                        <div class="form-card-header">
                            <div class="form-icon">＋</div>
                            <div>
                                <h3>Equipment Information</h3>
                                <p>Fill in the details to add a new item to the inventory.</p>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-grid">
                                <div class="field">
                                    <label for="name">Equipment Name <span class="required">*</span></label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="e.g. Starting Blocks"
                                        maxlength="150"
                                        required
                                        class="@error('name') input-invalid @enderror"
                                    >
                                    <div class="field-hint">Use a clear and recognizable equipment name.</div>
                                    @error('name')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="category_id">Category <span class="required">*</span></label>
                                    <select
                                        id="category_id"
                                        name="category_id"
                                        required
                                        class="@error('category_id') input-invalid @enderror"
                                    >
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                                            >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field full">
                                    <label for="description">Description</label>
                                    <textarea
                                        id="description"
                                        name="description"
                                        maxlength="1000"
                                        placeholder="Describe the equipment, its use, or any relevant details..."
                                        class="@error('description') input-invalid @enderror"
                                    >{{ old('description') }}</textarea>
                                    <div class="field-hint">Optional. Maximum 1,000 characters.</div>
                                    @error('description')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="quantity">Available Stock <span class="required">*</span></label>
                                    <input
                                        type="number"
                                        id="quantity"
                                        name="quantity"
                                        value="{{ old('quantity', 0) }}"
                                        min="0"
                                        required
                                        class="@error('quantity') input-invalid @enderror"
                                    >
                                    <div class="field-hint">The number of units currently available.</div>
                                    @error('quantity')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="minimum_stock">Minimum Stock <span class="required">*</span></label>
                                    <input
                                        type="number"
                                        id="minimum_stock"
                                        name="minimum_stock"
                                        value="{{ old('minimum_stock', 1) }}"
                                        min="0"
                                        required
                                        class="@error('minimum_stock') input-invalid @enderror"
                                    >
                                    <div class="field-hint">Used to identify items that need restocking.</div>
                                    @error('minimum_stock')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="condition">Condition <span class="required">*</span></label>
                                    <select
                                        id="condition"
                                        name="condition"
                                        required
                                        class="@error('condition') input-invalid @enderror"
                                    >
                                        <option value="Good" {{ old('condition', 'Good') == 'Good' ? 'selected' : '' }}>Good</option>
                                        <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                                        <option value="Damaged" {{ old('condition') == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                                    </select>
                                    @error('condition')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <a href="{{ route('equipment.index') }}" class="button button-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="button button-primary">
                                Save Equipment <span>→</span>
                            </button>
                        </div>
                    </form>
                @endif

                <div class="footer-note">
                    ATHLETEGEAR · SPORTS EQUIPMENT MANAGEMENT
                </div>
            </section>
        </main>
    </div>
</body>
</html>
