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
            </div>
        @endforeach

        <button onclick="window.location.href='/upload';">
        Upload
        </button>
</body>
</html>
