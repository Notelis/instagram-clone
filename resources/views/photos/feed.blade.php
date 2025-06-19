<!DOCTYPE html>
<html lang="en">
<head>
    <title>Instagram Feed</title>
    <style>
        /* CSS DARI KODE ASLI ANDA SEBELUMNYA */
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

        /* --- Perubahan atau Penambahan CSS untuk Like Button dan Profile Button --- */
        .like-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1em; /* Ukuran hati default */
            padding: 5px 0;
            /* Flexbox untuk menata ikon dan teks like count */
            display: flex;
            align-items: center;
            gap: 5px; /* Jarak antara ikon dan teks */
        }
        .like-button span { /* Untuk teks jumlah like */
            color: #262626; /* Warna teks default */
            font-size: 0.9em;
        }

        .like-button.liked {
            color: #ed4956; /* Warna merah untuk hati yang sudah di-like */
        }
        .like-button.not-liked {
            color: #262626; /* Warna hitam/abu-abu untuk hati yang belum di-like */
        }

        /* Styling untuk Archive/Unarchive/Save/Unsave buttons agar konsisten */
        /* Anda bisa menyesuaikan warna atau gaya ini */
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            padding: 5px 0;
            margin-left: 10px; /* Jarak antar tombol aksi */
            color: #0095f6; /* Contoh warna biru untuk tombol aksi */
        }
        .action-btn:hover {
            opacity: 0.8;
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

        /* Style untuk tombol "Profile" baru */
        .profile-nav-button {
            background-color: #0095f6; /* Warna biru konsisten dengan tombol lain */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none; /* Karena ini tag <a> */
            display: inline-block; /* Agar padding bekerja */
            margin-left: 20px; /* Jarak dari elemen sebelumnya */
            transition: background-color 0.2s ease;
        }

        .profile-nav-button:hover {
            background-color: #007acb;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/feed-icon.png') }}" alt="Logo" style="height: 30px;">
            <strong style="font-size: 1.2em;">Instagram Feed</strong>
        </div>
        <div>
            @auth
                👋 {{ auth()->user()->username }}
                <a href="/profile" class="profile-nav-button">Profile</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>

    <div class="search-bar">
        <form method="GET" action="{{ route('photos.feed') }}">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search">
            <button type="submit">Search</button>
        </form>
        <form method="GET" action="{{ route('photos.archived') }}" style="margin-top: 10px;">
            <button type="submit">📚 Archived Photos</button>
        </form>
    </div>

    <div class="feed-grid">
        @foreach ($photos as $photo)
            <div class="photo-card">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo">
                <div class="photo-caption">
                    <p>
                        <strong>
                            {{-- Jika Anda memiliki route 'user.profile' yang menerima username, gunakan ini: --}}
                            {{-- <a href="{{ route('user.profile', ['username' => $photo->user->username]) }}" style="text-decoration: none; color: black;"> --}}
                            {{-- Jika Anda hanya ingin ke /profile, gunakan ini: --}}
                            <a href="/profile" style="text-decoration: none; color: black;">
                                {{ $photo->user->username ?? '' }}
                            </a>
                        </strong>
                    </p>
                    <p>{{ $photo->caption }}</p>
                    <p style="color: gray; font-size: small;">{{ $photo->created_at->diffForHumans() }}</p>

                    @auth
                        @php
                            // Cek apakah user yang login sudah me-like foto ini
                            $userHasLiked = $photo->likes->contains('user_id', auth()->id());
                        @endphp
                        <form action="{{ route('photos.like', ['photo' => $photo->photo_id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="like-button {{ $userHasLiked ? 'liked' : 'not-liked' }}">
                                {{-- Ikon hati akan berubah berdasarkan status like --}}
                                {{ $userHasLiked ? '❤️' : '🤍' }} <span>({{ $photo->likes->count() }})</span>
                            </button>
                        </form>

                        @if ($photo->user_id === auth()->id())
                            @if ($photo->is_archived)
                                <form action="{{ route('photos.unarchive', $photo->photo_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn">🗑️ Unarchive</button>
                                </form>
                            @else
                                <form action="{{ route('photos.archive', $photo->photo_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn">🗂️ Archive</button>
                                </form>
                            @endif
                        @endif

                        @if (auth()->user()->savedPhotos->contains($photo))
                            <form action="{{ route('photos.unsave', $photo->photo_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="action-btn">🗑️ Unsave</button>
                            </form>
                        @else
                            <form action="{{ route('photos.save', $photo->photo_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="action-btn">💾 Save</button>
                            </form>
                        @endif
                    @endauth
                </div>

                <div class="comment-section">
                    <h4>Komentar:</h4>
                    @forelse ($photo->comments as $comment)
                        <p><strong>{{ $comment->user->username ?? '' }}</strong>: {{ $comment->comment_text }}<br>
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

    <div class="bottom-nav">
        <button class="upload-button" onclick="window.location.href='/upload';">+</button>
    </div>

</body>
</html>