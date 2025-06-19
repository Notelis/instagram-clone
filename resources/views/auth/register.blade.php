<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #fafafa;
            display: flex;
            flex-direction: column; /* Mengubah menjadi column agar kotak register dan link login bisa disusun vertikal */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px 0; /* Menambahkan padding untuk responsivitas */
            box-sizing: border-box;
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
            width: 175px; /* Sesuaikan sesuai kebutuhan */
            margin-bottom: 30px;
        }

        h2 {
            /* Sembunyikan H2 asli karena kita akan menggunakan gambar untuk logo atau intro text */
            display: none;
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
            border-radius: 8px; /* Sedikit lebih membulat untuk tombol */
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

        /* Menggabungkan dan menyesuaikan gaya pesan error */
        .message.error {
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 600;
            color: red;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="https://www.instagram.com/static/images/web/logged_out_wordmark.png/7a252de00b20.png" alt="Instagram" class="instagram-logo">

        <p class="intro-text">Sign up to see photos and videos from your friends.</p>

        {{-- Pesan Error Validasi --}}
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

        <p class="terms-text">By signing up, you agree to our <a href="#">Terms</a>, <a href="#">Data Policy</a> and <a href="#">Cookies Policy</a>.</p>
    </div>

    <div class="login-link">
        Have an account? <a href="/login">Log in</a>
    </div>
</body>
</html>