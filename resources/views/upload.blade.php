<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Photo - InstaClone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #dbdbdb;
        }

        .navbar img {
            height: 30px;
        }

        .container {
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #dbdbdb;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            font-weight: 500;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background-color: #3897f0;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        .feedback {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .back-button {
            margin-top: 15px;
            text-align: center;
        }

        .back-button button {
            background-color: #efefef;
            color: #262626;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/feed-icon.png') }}" alt="Logo">
            <strong style="font-size: 1.2em;">Instagram</strong>
        </div>
    </div>

    <div class="container">
        <h2>Upload Photo</h2>

        {{-- Show success message --}}
        @if (session('success'))
            <p class="feedback">{{ session('success') }}</p>
        @endif

        {{-- Show validation errors --}}
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Upload Form --}}
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="caption">Caption</label>
            <input type="text" name="caption" id="caption" required>

            <label for="image">Choose Photo</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <button type="submit">Upload</button>
        </form>

        <div class="back-button">
            <button onclick="window.location.href='{{ url('/feed') }}';">Back to Feed</button>
        </div>
    </div>

</body>
</html>
