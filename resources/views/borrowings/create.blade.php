
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Borrowing | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/borrowings-create.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <x-sidebar />

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
