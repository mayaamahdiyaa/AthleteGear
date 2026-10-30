
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category | AthleteGear</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/shared.css', 'resources/css/pages/categories-edit.css'])
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->isAdmin();
    @endphp

    <x-sidebar />

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">ATHLETEGEAR / CATEGORY CONTROL</div>

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
                <p class="eyebrow">ATHLETEGEAR / PERFORMANCE EQUIPMENT</p>
                <h1>Edit<br>Category</h1>
                <p class="hero-subtitle">Keep your category information accurate.</p>
            </div>

            <div class="hero-note">
                EVERY ITEM<br>
                HAS ITS PLACE<br>
                STAY ORGANIZED
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
                    <p class="section-label">Category Management</p>
                    <h2>Edit Category Details</h2>
                    <p>Update the name or description for this equipment category.</p>
                </div>

                <a href="{{ route('categories.index') }}" class="button button-outline">
                    ← Back to Categories
                </a>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-icon">✎</div>
                    <div>
                        <h3>Category Information</h3>
                        <p>Make changes to the existing category below.</p>
                    </div>
                </div>

                <form action="{{ route('categories.update', $category) }}" method="POST" class="category-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">
                            Category Name <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}"
                            placeholder="e.g. Running Shoes, Track Equipment"
                            required
                            maxlength="100"
                            autocomplete="off"
                        >

                        <p class="field-hint">
                            Use a clear name that describes the type of equipment.
                            Maximum 100 characters.
                        </p>

                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Describe what kind of equipment belongs in this category..."
                            maxlength="1000"
                            rows="5"
                        >{{ old('description', $category->description) }}</textarea>

                        <p class="field-hint">
                            Optional. Add details to help identify the category.
                            Maximum 1,000 characters.
                        </p>

                        @error('description')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="form-divider">

                    <div class="form-actions">
                        <span class="form-actions-note">
                            <span class="required">*</span> Required field
                        </span>

                        <div class="form-actions-buttons">
                            <a href="{{ route('categories.index') }}" class="button button-outline">
                                Cancel
                            </a>

                            <button type="submit" class="button button-primary">
                                ✓ Update Category
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
