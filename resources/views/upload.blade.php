<!DOCTYPE html>
<html>
<head>
    <title>Upload Photo</title>
</head>
<body>
    <h1>Upload Photo</h1>

    {{-- Show success message --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Upload Form --}}
    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="caption">Caption:</label><br>
        <input type="text" name="caption" id="caption" required><br><br>

        <label for="image">Choose Photo:</label><br>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>

        <button type="submit">Upload</button>
    </form>

    <br></br>
    <button onclick="window.location.href='/feed';">
    Feed
    </button>

</body>
</html>
