<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Profil Pengguna</h2>

    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Bio:</strong> {{ $user->bio ?? 'Belum ada bio.' }}</p>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/profile/bio">
        @csrf
        <label>Update Bio:</label><br>
        <textarea name="bio" rows="4" cols="40">{{ $user->bio }}</textarea><br><br>
        <button type="submit">Simpan Bio</button>
    </form>

    <form method="GET" action="/feed" style="margin-top: 20px;">
        @csrf
        <button type="submit">Feed</button>
    </form>

    <form action="{{ route('photos.saved') }}" method="GET" style="margin-top: 20px;">
    @csrf
    <button type="submit">🖼️ Saved Photos</button>
    </form>

    <form method="POST" action="/logout" style="margin-top: 20px;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
