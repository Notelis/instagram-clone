<!DOCTYPE html>
<html>
<head>
    <title>Instagram Feed</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding-bottom: 70px;
        }

        .navbar {
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #dbdbdb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar {
            padding: 10px 20px;
            background-color: white;
            border-bottom: 1px solid #dbdbdb;
        }

        .feed-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 600px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .photo-card {
            background-color: white;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            overflow: hidden;
        }

        .photo-card img {
            width: 100%;
            display: block;
        }

        .photo-caption, .comment-section {
            padding: 10px;
        }

        .photo-caption p, .comment-section p {
            margin: 6px 0;
        }

        .comment-section textarea {
            width: 100%;
            border-radius: 4px;
            padding: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        .like-button {
            background: none;
            border: none;
            color: red;
            cursor: pointer;
            font-size: 1.1em;
            padding: 5px 0;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            border-top: 1px solid #dbdbdb;
            padding: 10px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .upload-button {
            background-color: #0095f6;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 22px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/feed-icon.png') }}" alt="Logo" style="height: 30px;">
            <strong style="font-size: 1.2em;">Instagram Feed</strong>
        </div>
        <div>
            @auth
                👤 
                @if (auth()->user()->username == 'admin') {{-- atau kondisi spesifik lain --}}
                    <a href="{{ url('/profile') }}">{{ auth()->user()->username }}</a>
                @else
                    <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}">
                        {{ auth()->user()->username }}
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>

    <!-- Search bar -->
    <div class="search-bar">
        <form method="GET" action="{{ route('photos.feed') }}">
            <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Search">
            <button type="submit">Search</button>
        </form>
        <form method="GET" action="{{ route('photos.archived') }}" style="margin-top: 10px;">
            <button type="submit">📚 Archived Photos</button>
        </form>
    </div>

    <!-- Feed -->
    <div class="feed-grid">
        @foreach ($photos as $photo)
            <div class="photo-card">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo">
                <div class="photo-caption">
                    <p>
                        <strong>
                            <a href="{{ route('user.profile', ['username' => $photo->user->username]) }}" style="text-decoration: none; color: black;">
                                {{ $photo->user->username ?? 'User' }}
                            </a>
                        </strong>
                    </p>
                    <p>{{ $photo->caption }}</p>
                    <p style="color: gray; font-size: small;">{{ $photo->created_at->diffForHumans() }}</p>

                    @auth
                        <form action="{{ route('photos.like', ['photo' => $photo->photo_id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="like-button">❤️ Like ({{ $photo->likes->count() }})</button>
                        </form>

                        <!-- Archive or Unarchive -->
                        @if ($photo->user_id === auth()->id())
                            @if ($photo->is_archived)
                                <form action="{{ route('photos.unarchive', $photo->photo_id) }}" method="POST">
                                    @csrf
                                    <button type="submit">🗑️ Unarchive</button>
                                </form>
                            @else
                                <form action="{{ route('photos.archive', $photo->photo_id) }}" method="POST">
                                    @csrf
                                    <button type="submit">🗂️ Archive</button>
                                </form>
                            @endif
                        @endif

                        <!-- Save or Unsave -->
                        @if (auth()->user()->savedPhotos->contains($photo))
                            <form action="{{ route('photos.unsave', $photo->photo_id) }}" method="POST">
                                @csrf
                                <button type="submit">🗑️ Unsave</button>
                            </form>
                        @else
                            <form action="{{ route('photos.save', $photo->photo_id) }}" method="POST">
                                @csrf
                                <button type="submit">💾 Save</button>
                            </form>
                        @endif
                    @endauth
                </div>

                <!-- Komentar -->
                <div class="comment-section">
                    <h4>Komentar:</h4>
                    @forelse ($photo->comments as $comment)
                        <p><strong>{{ $comment->user->username ?? 'Anonim' }}</strong>: {{ $comment->comment_text }}<br>
                        <small>{{ $comment->created_at->diffForHumans() }}</small></p>
                    @empty
                        <p><em>Belum ada komentar</em></p>
                    @endforelse

                    @auth
                        <form action="/photos/{{ $photo->photo_id }}/comments" method="POST">
                            @csrf
                            <textarea name="comment_text" rows="2" placeholder="Tulis komentar..." required></textarea>
                            <br>
                            <button type="submit">Kirim Komentar</button>
                        </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bottom Nav -->
    <div class="bottom-nav">
        <button class="upload-button" onclick="window.location.href='/upload';">+</button>
    </div>

</body>
</html>
