<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna - InstaClone</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #dbdbdb;
        }

        .navbar img {
            height: 30px;
            margin-right: 10px;
        }

        .navbar strong {
            font-size: 1.2em;
        }

        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #dbdbdb;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        p {
            margin: 10px 0;
        }

        .success-message {
            color: green;
            margin-top: 15px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
            resize: vertical;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 6px;
            background-color: #3897f0;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-secondary {
            background-color: #efefef;
            color: #262626;
        }

        .btn-logout {
            background-color: #ff4d4d;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <img src="{{ asset('images/feed-icon.png') }}" alt="Logo">
        <strong>InstaClone</strong>
    </div>

    <!-- Profile Card -->
    <div class="container">
        <h2>Profil Pengguna</h2>

        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Bio:</strong> {{ $user->bio ?? 'Belum ada bio.' }}</p>

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <!-- Form Update Bio -->
        <form method="POST" action="/profile/bio">
            @csrf
            <label for="bio">Update Bio:</label>
            <textarea name="bio" id="bio" rows="4">{{ $user->bio }}</textarea>
            <button class="btn" type="submit">Simpan Bio</button>
        </form>

        <!-- Tombol Navigasi -->
        <form method="GET" action="/feed">
            <button class="btn btn-secondary" type="submit">⬅️ Kembali ke Feed</button>
        </form>

        <form method="GET" action="{{ route('photos.saved') }}">
            <button class="btn btn-secondary" type="submit">🖼️ Lihat Foto Tersimpan</button>
        </form>

        <!-- Logout -->
        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-logout" type="submit">🚪 Logout</button>
        </form>
    </div>

</body>
</html>
