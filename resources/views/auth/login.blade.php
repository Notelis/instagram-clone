<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px 0;
            box-sizing: border-box;
        }

        .login-container {
            background-color: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            padding: 40px;
            text-align: center;
            width: 350px;
            box-sizing: border-box;
        }

        .instagram-logo {
            width: 175px;
            margin-bottom: 30px;
        }

        h2 {
            display: none;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            background-color: #fafafa;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            padding: 10px 8px;
            margin-bottom: 6px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #0095f6;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 0;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s ease;
        }

        .login-container button:hover {
            background-color: #007acb;
        }

        .signup-link {
            background-color: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            padding: 20px;
            text-align: center;
            width: 350px;
            margin-top: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .signup-link a {
            color: #0095f6;
            text-decoration: none;
            font-weight: 600;
        }

        .message {
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/feed-icon.png') }}" alt="Logo" class="instagram-logo">

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <p class="message success">{{ session('success') }}</p>
        @endif

        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
            <p class="message error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="/login">
            @csrf
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Log In</button>
        </form>
    </div>

    <div class="signup-link">
        Don't have an account? <a href="/register">Sign up</a>
    </div>
</body>
</html>
