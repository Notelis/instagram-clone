<!DOCTYPE html>
<html>
<head>
    <title>Instagram Feed</title>
</head>
<body>
    <img src="{{ asset('images/feed-icon.png') }}" alt="My Image" width="300">


    @foreach ($photos as $photo)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" style="max-width: 300px;"><br>
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <small>Uploaded at: {{ $photo->created_at->format('Y-m-d H:i') }}</small>

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
                <form action="{{ route('comments.store', ['photo_id' => $photo->id]) }}" method="POST">
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
