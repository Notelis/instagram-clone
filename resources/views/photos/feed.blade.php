<!DOCTYPE html>
<html>
<head>
    <title>Instagram Feed</title>
</head>
<body>

    @auth
    <p>Welcome, {{ auth()->user()->username }}</p>
    @endauth

    @guest
        <p>guest() check: ❌ You are not logged in</p>
    @endguest

    <img src="{{ asset('images/feed-icon.png') }}" alt="My Image" width="300">

    @foreach ($photos as $photo)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" style="max-width: 300px;"><br>
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <small>Uploaded at: {{ $photo->created_at->format('Y-m-d H:i') }}</small>

            @auth
            <form action="{{ route('photos.like', ['photo' => $photo->id]) }}" method="POST">
            @csrf
            <button type="submit">❤️ Like ({{ $photo->likes->count() }})</button>
        </form>
        @endauth
    </div>

            <hr>

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
                @if (isset($photo->id))
                <form action="{{ route('comments.store', ['photo' => $photo->id]) }}" method="POST">
                    @csrf
                    <textarea name="body" rows="2" style="width: 100%;" placeholder="Tulis komentar..." required></textarea>
                    <button type="submit">Kirim Komentar</button>
                </form>
                @endif
            @endauth
        </div>
    @endforeach
    
    <button onclick="window.location.href='/upload';">
    Upload
    </button>
</body>
</html>