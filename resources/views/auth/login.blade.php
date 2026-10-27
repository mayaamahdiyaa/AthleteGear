
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AthleteGear</title>
</head>
<body>
    <h1>AthleteGear</h1>
    <h2>Login to Your Account</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Login</button>
    </form>

    <p>
        Don't have an account?
        <a href="{{ route('register') }}">Register</a>
    </p>
</body>
</html>
