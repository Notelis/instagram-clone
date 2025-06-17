<!DOCTYPE html>
<html>
<head>
    <title>Instagram Feed</title>
</head>
<body>
    <img src="{{ asset('images/feed-icon.png') }}" alt="My Image" width="300">
    @auth
        <p style="color: green;">Login sebagai: {{ auth()->user()->name }}</p>
    @endauth

    @guest
        <p style="color: red;">Kamu belum login. <a href="{{ route('login') }}">Klik di sini untuk login</a></p>
    @endguest

    @foreach ($photos as $photo)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" style="max-width: 300px;"><br>
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <small>Uploaded at: {{ $photo->created_at->format('Y-m-d H:i') }}</small>

            <hr>
            <!-- degug photo -->
            <p><strong>Debug ID Foto:</strong> {{ $photo->id ?? 'ID NULL' }}</p>

            <h4>Komentar:</h4>
            @forelse ($photo->comments as $comment)
                <p>
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}
                    <br>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </p>
            @empty
                <p><em>Belum ada komentar</em></p>
            @endforelse

            @auth
                <form action="/photos/{{ $photo->id }}/comments" method="POST">
                    @csrf
                    <textarea name="body" rows="2" style="width: 100%;" placeholder="Tulis komentar..." required></textarea>
                    <button type="submit">Kirim Komentar</button>
                </form>
            @endauth
        </div>
    @endforeach

    <button onclick="window.location.href='/upload';">
    Upload
    </button>
</body>
</html>