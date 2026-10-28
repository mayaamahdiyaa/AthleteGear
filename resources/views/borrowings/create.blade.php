
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Borrowing | AthleteGear</title>

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

        button,
        input,
        select {
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

        /* HERO */
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

        .flash.error {
            color: #A72C35;
            background: #FFF0F0;
            border-color: #F0CACA;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: #59656D;
            font-size: 12px;
            font-weight: 700;
        }

        .back-link:hover {
            color: var(--red-dark);
        }

        .form-card {
            max-width: 850px;
            overflow: hidden;
            background: white;
            border: 1px solid #DFE3E3;
            border-radius: 8px;
        }

        .form-header {
            padding: 23px 26px;
            border-bottom: 1px solid var(--line);
        }

        .form-header h2 {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 29px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .form-header p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .form-body {
            display: grid;
            gap: 22px;
            padding: 26px;
        }

        .field {
            display: grid;
            gap: 9px;
        }

        .field label {
            color: #35414A;
            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: var(--red);
        }

        .field input,
        .field select {
            width: 100%;
            min-height: 45px;
            padding: 12px 14px;
            border: 1px solid #D8DDDF;
            border-radius: 6px;
            outline: none;
            background: white;
            color: var(--text);
            font-size: 12px;
        }

        .field input:focus,
        .field select:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px #D943431C;
        }

        .field input.is-invalid,
        .field select.is-invalid {
            border-color: var(--red);
        }

        .field-error {
            margin: 0;
            color: #B52C35;
            font-size: 11px;
            line-height: 1.5;
        }

        .field-hint {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .availability-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px;
            border: 1px solid #DCE6DD;
            border-radius: 6px;
            background: #F2F7F2;
        }

        .availability-icon {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            border-radius: 50%;
            color: var(--green);
            background: #DCEBDD;
            font-weight: 800;
        }

        .availability-note strong {
            display: block;
            margin-bottom: 4px;
            color: #315A3C;
            font-size: 12px;
        }

        .availability-note p {
            margin: 0;
            color: #5D7463;
            font-size: 11px;
            line-height: 1.6;
        }

        .empty-state {
            padding: 42px 25px;
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 12px;
            font-size: 38px;
        }

        .empty-state h3 {
            margin: 0 0 8px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            text-transform: uppercase;
        }

        .empty-state p {
            margin: 0 0 20px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            padding: 18px 26px;
            border-top: 1px solid var(--line);
            background: #FDFDFC;
        }

        .button {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 15px;
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

        .button-outline {
            color: var(--text);
            background: white;
            border-color: #D4DADD;
        }

        .button-outline:hover {
            background: #F5F6F5;
        }

        .page-footer {
            max-width: 850px;
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

            .form-header {
                padding: 20px;
            }

            .form-body {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 22px;
            }

            .form-footer {
                padding: 16px 20px;
            }

            .form-footer .button {
                flex: 1;
            }
        }
    </style>
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
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
            <a href="{{ route('equipment.index') }}" class="nav-link">
                <span class="nav-icon">▤</span>
                Equipment
            </a>

            @if ($isAdmin)
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <span class="nav-icon">▦</span>
                    Categories
                </a>
            @endif

            <a href="{{ route('borrowings.index') }}" class="nav-link active">
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
            <div class="topbar-title">ATHLETEGEAR / BORROWING CONTROL</div>

            <div class="user-area">
                <div class="avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

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
            <div class="hero-copy">
                <p class="eyebrow">ATHLETEGEAR / EQUIPMENT MANAGEMENT</p>
                <h1>Borrow<br>Equipment</h1>
                <p class="hero-subtitle">Get the gear you need for your next training session.</p>
            </div>

            <div class="hero-note">
                PICK YOUR GEAR<br>
                SET YOUR DATES<br>
                STAY READY
                <span></span>
            </div>
        </section>

        <section class="content">
            @if ($errors->any())
                <div class="flash error" role="alert">
                    <strong>Please check the following:</strong>
                    <ul style="margin: 8px 0 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('borrowings.index') }}" class="back-link">
                ← Back to Borrowings
            </a>

            <div class="form-card">
                @if ($equipment->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📦</div>
                        <h3>No Equipment Available</h3>
                        <p>
                            There is currently no equipment available to borrow.
                            Check the inventory for updates or try again later.
                        </p>

                        <a href="{{ route('equipment.index') }}" class="button button-primary">
                            View Equipment
                        </a>
                    </div>
                @else
                    <div class="form-header">
                        <h2>New Borrowing Request</h2>
                        <p>Select your equipment, choose the quantity, and set an optional due date.</p>
                    </div>

                    <form action="{{ route('borrowings.store') }}" method="POST">
                        @csrf

                        <div class="form-body">
                            <div class="availability-note">
                                <div class="availability-icon">✓</div>
                                <div>
                                    <strong>Available Equipment</strong>
                                    <p>
                                        Only equipment with available stock is listed.
                                        Please choose a quantity that does not exceed the available stock.
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <label for="equipment_id">
                                    Equipment <span class="required">*</span>
                                </label>

                                <select
                                    id="equipment_id"
                                    name="equipment_id"
                                    class="@error('equipment_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Select equipment</option>

                                    @foreach ($equipment as $item)
                                        <option
                                            value="{{ $item->id }}"
                                            data-quantity="{{ $item->quantity }}"
                                            {{ (string) old('equipment_id') === (string) $item->id ? 'selected' : '' }}
                                        >
                                            {{ $item->name }}
                                            — {{ $item->category->name ?? 'Uncategorized' }}
                                            (Available: {{ $item->quantity }})
                                        </option>
                                    @endforeach
                                </select>

                                @error('equipment_id')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror

                                <p class="field-hint" id="equipmentHint">
                                    Choose the equipment you want to borrow.
                                </p>
                            </div>

                            <div class="form-row">
                                <div class="field">
                                    <label for="quantity">
                                        Quantity to Borrow <span class="required">*</span>
                                    </label>

                                    <input
                                        type="number"
                                        id="quantity"
                                        name="quantity"
                                        value="{{ old('quantity', 1) }}"
                                        min="1"
                                        required
                                        class="@error('quantity') is-invalid @enderror"
                                    >

                                    @error('quantity')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror

                                    <p class="field-hint" id="quantityHint">
                                        Enter how many units you need.
                                    </p>
                                </div>

                                <div class="field">
                                    <label for="due_date">Due Date (Optional)</label>

                                    <input
                                        type="date"
                                        id="due_date"
                                        name="due_date"
                                        value="{{ old('due_date') }}"
                                        min="{{ now()->toDateString() }}"
                                        class="@error('due_date') is-invalid @enderror"
                                    >

                                    @error('due_date')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror

                                    <p class="field-hint">
                                        Select the date you plan to return the equipment.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <a href="{{ route('borrowings.index') }}" class="button button-outline">
                                Cancel
                            </a>

                            <button type="submit" class="button button-primary">
                                ✓ Confirm Borrowing
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <footer class="page-footer">
                ATHLETEGEAR · TRACK &amp; FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>

    <script>
        const equipmentSelect = document.getElementById('equipment_id');
        const quantityInput = document.getElementById('quantity');
        const equipmentHint = document.getElementById('equipmentHint');
        const quantityHint = document.getElementById('quantityHint');

        function updateEquipmentAvailability() {
            if (!equipmentSelect || !quantityInput) {
                return;
            }

            const selectedOption = equipmentSelect.options[equipmentSelect.selectedIndex];

            if (!selectedOption || !selectedOption.value) {
                quantityInput.removeAttribute('max');
                equipmentHint.textContent = 'Choose the equipment you want to borrow.';
                quantityHint.textContent = 'Enter how many units you need.';
                return;
            }

            const availableQuantity = Number(selectedOption.dataset.quantity || 0);

            quantityInput.max = availableQuantity;
            equipmentHint.textContent = 'Available stock: ' + availableQuantity + ' unit(s).';
            quantityHint.textContent = 'You can borrow up to ' + availableQuantity + ' unit(s).';

            if (Number(quantityInput.value) > availableQuantity) {
                quantityInput.value = availableQuantity;
            }

            if (availableQuantity < 1) {
                quantityInput.value = 1;
            }
        }

        if (equipmentSelect && quantityInput) {
            equipmentSelect.addEventListener('change', updateEquipmentAvailability);

            quantityInput.addEventListener('input', function () {
                const maxQuantity = Number(quantityInput.max || 0);

                if (maxQuantity > 0 && Number(quantityInput.value) > maxQuantity) {
                    quantityInput.value = maxQuantity;
                }
            });

            updateEquipmentAvailability();
        }
    </script>
</body>
</html>
