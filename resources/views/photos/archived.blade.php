<!DOCTYPE html>
<html>
<head>
    <title>Photos Archived</title>
</head>
<body>
    <h2>🗃️ Archive 🗃️</h2>

    @foreach ($photos as $photo)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" style="max-width: 300px;">
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <small>Uploaded at: {{ $photo->created_at->format('Y-m-d H:i') }}</small>

            <form action="{{ route('photos.unarchive', $photo->photo_id) }}" method="POST">
                @csrf
                <button type="submit">🗑️ Unarchive</button>
            </form>
        </div>
    @endforeach

    <a href="{{ route('photos.feed') }}">← Return to Feed</a>
</body>
</html>
