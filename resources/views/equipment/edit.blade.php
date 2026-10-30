
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Equipment | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/equipment-edit.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <x-sidebar />

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
                <h1>Edit<br>Equipment</h1>
                <p class="hero-subtitle">Keep your equipment data accurate.</p>
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

            <div class="page-heading">
                <div>
                    <p class="section-eyebrow">INVENTORY MANAGEMENT / UPDATE</p>
                    <h2 class="section-title">Edit Equipment Details</h2>
                    <p class="section-description">
                        Update the information for
                        <strong>{{ $equipment->name }}</strong>.
                    </p>
                </div>

                <a href="{{ route('equipment.index') }}" class="button button-outline">
                    ← Back to Inventory
                </a>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-icon">✎</div>
                    <div>
                        <h2>Equipment Information</h2>
                        <p>Fields marked with * are required.</p>
                    </div>
                </div>

                <form
                    action="{{ route('equipment.update', $equipment) }}"
                    method="POST"
                    class="equipment-form"
                >
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Equipment Name <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $equipment->name) }}"
                                placeholder="e.g. Athletics Hurdle"
                                maxlength="255"
                                required
                            >

                            @error('name')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="form-label">
                                Category <span class="required">*</span>
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                class="form-control"
                                required
                            >
                                <option value="">Select a category</option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ (string) old('category_id', $equipment->category_id) === (string) $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group full-width">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                placeholder="Describe the equipment, its purpose, or other details..."
                            >{{ old('description', $equipment->description) }}</textarea>

                            @error('description')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="form-label">
                                Available Stock <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                class="form-control"
                                value="{{ old('quantity', $equipment->quantity) }}"
                                min="0"
                                required
                            >

                            <p class="form-help">
                                Enter the current quantity available in inventory.
                            </p>

                            @error('quantity')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="minimum_stock" class="form-label">
                                Minimum Stock <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                id="minimum_stock"
                                name="minimum_stock"
                                class="form-control"
                                value="{{ old('minimum_stock', $equipment->minimum_stock) }}"
                                min="0"
                                required
                            >

                            <p class="form-help">
                                Used to identify equipment that needs restocking.
                            </p>

                            @error('minimum_stock')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="condition" class="form-label">
                                Equipment Condition <span class="required">*</span>
                            </label>

                            <select
                                id="condition"
                                name="condition"
                                class="form-control"
                                required
                            >
                                @foreach (['Good', 'Fair', 'Poor'] as $condition)
                                    <option
                                        value="{{ $condition }}"
                                        {{ old('condition', $equipment->condition) === $condition ? 'selected' : '' }}
                                    >
                                        {{ $condition }}
                                    </option>
                                @endforeach
                            </select>

                            @error('condition')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="form-divider">

                    <div class="form-actions">
                        <p class="form-help">
                            Changes will be saved to the equipment inventory.
                        </p>

                        <div class="form-actions-right">
                            <a href="{{ route('equipment.index') }}" class="button button-outline">
                                Cancel
                            </a>

                            <button type="submit" class="button button-primary">
                                ✓ Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <footer class="page-footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>
</body>
</html>
