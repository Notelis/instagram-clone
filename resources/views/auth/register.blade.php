<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Instagram Clone</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            margin: 0;
        }

        .navbar {
            width: 100%;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #dbdbdb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .register-container {
            margin-top: 60px;
            width: 100%;
            max-width: 350px;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            padding: 30px;
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #dbdbdb;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #0095f6;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .bottom-text {
            margin-top: 20px;
            font-size: 14px;
        }

        .error-message {
            margin-bottom: 10px;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/feed-icon.png') }}" alt="Logo" style="height: 30px;">
            <strong style="font-size: 1.2em;">Instagram</strong>
        </div>
        <div></div>
    </div>

    <!-- Register Form -->
    <div class="register-container">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password (min 8 karakter)" required>
            <button type="submit">Register</button>
        </form>

        <div class="bottom-text">
            Sudah punya akun? <a href="/login">Login di sini</a>
        </div>
    </div>

</body>
</html>
