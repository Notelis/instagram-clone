<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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

        .register-container {
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

        .register-container p.intro-text {
            color: #8e8e8e;
            font-size: 17px;
            font-weight: 600;
            line-height: 20px;
            margin: 0 40px 20px;
        }

        .register-container form {
            display: flex;
            flex-direction: column;
        }

        .register-container input {
            background-color: #fafafa;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            padding: 10px 8px;
            margin-bottom: 6px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .register-container button {
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

        .register-container button:hover {
            background-color: #007acb;
        }

        .terms-text {
            color: #8e8e8e;
            font-size: 12px;
            line-height: 16px;
            margin: 10px 40px;
        }

        .terms-text a {
            color: #00376b;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link {
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

        .login-link a {
            color: #0095f6;
            text-decoration: none;
            font-weight: 600;
        }

        .message {
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="https://www.instagram.com/static/images/web/logged_out_wordmark.png/7a252de00b20.png" alt="Instagram" class="instagram-logo">

        <p class="intro-text">Sign up to see photos and videos from your friends.</p>

        @if ($errors->any())
            <p class="message error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="/register">
            @csrf
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>

            <button type="submit">Register</button>
        </form>

  </div>

    <div class="login-link">
        Have an account? <a href="/login">Log in</a>
    </div>
</body>
</html>