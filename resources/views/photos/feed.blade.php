<!DOCTYPE html>
<html>
<head>
    <title>Instagram Feed</title>
</head>
<body>\

    <img src="{{ asset('images/feed-icon.png') }}" alt="My Image" width="300">
    @auth
        <p style="color: green;">Login sebagai: {{ auth()->user()->username }}</p>
    @endauth

    @guest
        <p style="color: red;">Kamu belum login. <a href="{{ route('login') }}">Klik di sini untuk login</a></p>
    @endguest

    <form method="GET" action="/profile" style="margin-top: 20px;">
        @csrf
    <button type="submit">Profile</button>

    <div style="margin-top: 20px;">
        
    <form method="GET" action="{{ route('photos.feed') }}">
    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search" style="width: 200px;">
    <button type="submit">Search</button>
    </form>
    <br>

    @foreach ($photos as $photo)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" style="max-width: 300px;"><br>
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <small>Uploaded at: {{ $photo->created_at->format('Y-m-d H:i') }}</small>
            
            @auth
            <form action="{{ route('photos.like', ['photo' => $photo->photo_id]) }}" method="POST">
            @csrf
            <button type="submit">❤️ Like ({{ $photo->likes->count() }})</button>
        </form>
        @endauth
    </div>

            <hr>

            <h4>Komentar:</h4>
            @forelse ($photo->comments as $comment)
                <p>
                    <strong>{{ $comment->user->username ?? 'User tidak ditemukan' }}</strong>: {{ $comment->comment_text }}
                    <br>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </p>
            @empty
                <p><em>Belum ada komentar</em></p>
            @endforelse

            @auth
                <form action="/photos/{{ $photo->photo_id }}/comments" method="POST">
                    @csrf
                    <textarea name="comment_text" rows="2" style="width: 100%;" placeholder="Tulis komentar..." required></textarea>
                    <button type="submit">Kirim Komentar</button>
                </form>
            @endauth
        </div>
    @endforeach
    
    <form method="GET" action="/upload" style="margin-top: 20px;">
        @csrf
        <button type="submit">Upload</button>
    </form>
</body>
</html>