<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #fafafa;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #ccc;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar strong {
            font-size: 1.2em;
        }

        .photo-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            margin: 20px auto;
            max-width: 400px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .photo-card img {
            max-width: 100%;
            border-radius: 6px;
        }

        .photo-card p {
            margin: 10px 0;
        }

        .photo-card form {
            margin-top: 10px;
        }

        .return-link {
            display: block;
            text-align: center;
            margin: 30px 0;
            color: #555;
            text-decoration: none;
        }

        .return-link:hover {
            text-decoration: underline;
        }

        button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/feed-icon.png') }}" alt="Logo" style="height: 30px;">
            <strong>Instagram Saved</strong>
        </div>
        <div>
            @auth
                👋 <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}">{{ auth()->user()->username }}</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>

    <h2 style="text-align:center; margin-top: 20px;">📌 Saved Posts 📌</h2>

    @forelse ($photos as $photo)
        <div class="photo-card">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo">
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <small>Uploaded at: {{ $photo->created_at->format('Y-m-d H:i') }}</small>

            <form action="{{ route('photos.unsave', $photo->photo_id) }}" method="POST">
                @csrf
                <button type="submit">🗑️ Unsave</button>
            </form>
        </div>
    @empty
        <p style="text-align:center; margin-top: 50px;">Belum ada foto yang disimpan.</p>
    @endforelse

    <a href="{{ route('photos.feed') }}" class="return-link">← Return to Feed</a>

</body>
</html>
