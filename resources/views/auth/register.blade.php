<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up &bull; Instagram</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="form-container" style="max-width: 350px; margin: 0 auto;">
                <div class="form-content box">
                    <div class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Instagram logo" class="logo-font">
                    </div>
                    <h2 class="form-title">Sign up to see photos and videos from your friends.</h2>
                    <div class="social-login">
                        <button type="button" class="btn-facebook">
                            <span class="facebook-icon"></span>
                            <span>Log in with Facebook</span>
                        </button>
                    </div>
                    <div class="or-container">
                        <div class="line"></div>
                        <div class="or">OR</div>
                        <div class="line"></div>
                    </div>
                    <form class="login-form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="animated-input">
                                <input type="email" id="email" name="email" required>
                                <label for="email">Mobile Number or Email</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="animated-input">
                                <input type="text" id="name" name="name" required>
                                <label for="name">Full Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="animated-input">
                                <input type="text" id="username" name="username" required>
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="animated-input">
                                <input type="password" id="password" name="password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="animated-input">
                                <input type="password" id="password_confirmation" name="password_confirmation" required>
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-login">Sign up</button>
                        </div>
                    </form>
                </div>
                <div class="box">
                    <p>Have an account? <a href="{{ route('login') }}">Log in</a></p>
                </div>
                <div class="app-download">
                    <p>Get the app.</p>
                    <div class="store-logos">
                        <a href="#"><img src="{{ asset('images/app-store.png') }}" alt="App Store"></a>
                        <a href="#"><img src="{{ asset('images/google-play.png') }}" alt="Google Play"></a>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer-container">
                <a href="#">Meta</a>
                <a href="#">About</a>
                <a href="#">Blog</a>
                <a href="#">Jobs</a>
                <a href="#">Help</a>
                <a href="#">API</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Top Accounts</a>
                <a href="#">Locations</a>
                <a href="#">Instagram Lite</a>
                <a href="#">Contact Uploading & Non-Users</a>
                <a href="#">Meta Verified</a>
                <span>English</span>
                <span>&copy; 2023 Instagram from Meta</span>
            </div>
        </footer>
    </div>
</body>
</html>