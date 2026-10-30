
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Equipment - AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,600;0,700;0,800;1,600;1,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/equipment-create.css'])
</head>
<body>
    @php
        $currentUser = auth()->user();
        $isAdmin = $currentUser && $currentUser->isAdmin();
    @endphp

    <div class="layout">
        <x-sidebar />

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
