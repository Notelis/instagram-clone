<h2>📌 Gallery 📌</h2>

@foreach ($photos as $photo)
    <div>
        <img src="{{ asset('storage/' . $photo->image_path) }}" style="max-width:300px;">
        <p>{{ $photo->caption }}</p>
        <form action="{{ route('photos.unsave', $photo->photo_id) }}" method="POST">
                @csrf
                <button type="submit">🗑️ Unsave</button>
            </form>
    </div>
@endforeach

<a href="{{ route('photos.feed') }}">← Back to Feed</a>
