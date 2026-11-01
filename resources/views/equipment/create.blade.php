
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Equipment | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/equipment-create.css'])
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
                <h1>Add New<br>Equipment</h1>
                <p class="hero-subtitle">Register gear and keep your inventory organized.</p>
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
                    <p class="section-eyebrow">INVENTORY MANAGEMENT / NEW ITEM</p>
                    <h2 class="section-title">Add Equipment</h2>
                    <p class="section-description">
                        Fields marked with <strong>*</strong> are required.
                    </p>
                </div>

                <a href="{{ route('equipment.index') }}" class="button button-outline">
                    ← Back to Inventory
                </a>
            </div>

            @if ($categories->isEmpty())
                <div class="notice">
                    <span class="notice-icon">ⓘ</span>
                    <div>
                        <strong>No categories available</strong>
                        You need to create a category before adding equipment.
                        @if ($isAdmin)
                            <a href="{{ route('categories.create') }}">Create a category →</a>
                        @endif
                    </div>
                </div>
            @else
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-icon">＋</div>
                        <div>
                            <h2>Equipment Information</h2>
                            <p>Fill in the details to add a new item to the inventory.</p>
                        </div>
                    </div>

                    <form
                        action="{{ route('equipment.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="equipment-form"
                    >
                        @csrf

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    Equipment Name <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') input-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="e.g. Starting Blocks"
                                    maxlength="150"
                                    required
                                >

                                <p class="form-help">
                                    Use a clear and recognizable equipment name.
                                </p>

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
                                    class="form-control @error('category_id') input-invalid @enderror"
                                    required
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

                            <div class="form-group full-width">
                                <label for="description" class="form-label">
                                    Description
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control @error('description') input-invalid @enderror"
                                    placeholder="Describe the equipment, its use, or any relevant details..."
                                    maxlength="1000"
                                >{{ old('description') }}</textarea>

                                <p class="form-help">
                                    Optional. Maximum 1,000 characters.
                                </p>

                                @error('description')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">
                                    Equipment Photo
                                </label>

                                @include('equipment.partials.image-upload', [
                                    'currentImageUrl' => null,
                                    'currentImageName' => null,
                                ])

                                <p class="form-help">
                                    Optional. Take a photo, pick from gallery, or choose a file.
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="form-label">
                                    Available Stock <span class="required">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    class="form-control @error('quantity') input-invalid @enderror"
                                    value="{{ old('quantity', 0) }}"
                                    min="0"
                                    required
                                >

                                <p class="form-help">
                                    The number of units currently available.
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
                                    class="form-control @error('minimum_stock') input-invalid @enderror"
                                    value="{{ old('minimum_stock', 1) }}"
                                    min="0"
                                    required
                                >

                                <p class="form-help">
                                    Used to identify items that need restocking.
                                </p>

                                @error('minimum_stock')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="condition" class="form-label">
                                    Condition <span class="required">*</span>
                                </label>

                                <select
                                    id="condition"
                                    name="condition"
                                    class="form-control @error('condition') input-invalid @enderror"
                                    required
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
                                    ✓ Save Equipment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <footer class="page-footer">
                ATHLETEGEAR · TRACK & FIELD EQUIPMENT MANAGEMENT
            </footer>
        </section>
    </main>
</body>
</html>
