<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &bull; Instagram</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="main-content">
                <div class="slide-container" style="background-image: url('{{ asset('images/bg.png') }}');">
                    <div class="slide-content" id="slide-content">
                        <img src="{{ asset('images/slide1.png') }}" class="active" alt="slide image">
                        <img src="{{ asset('images/slide2.png') }}" alt="slide image">
                        <img src="{{ asset('images/slide3.png') }}" alt="slide image">
                    </div>
                </div>
                <div class="form-container">
                    <div class="form-content box">
                        <div class="logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Instagram logo" class="logo-font">
                        </div>
                        <form class="login-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="animated-input">
                                    <input type="text" id="username" name="username" required>
                                    <label for="username">Phone number, username, or email</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="animated-input">
                                    <input type="password" id="password" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-login">Log In</button>
                            </div>
                            <div class="or-container">
                                <div class="line"></div>
                                <div class="or">OR</div>
                                <div class="line"></div>
                            </div>
                            <div class="social-login">
                                <button type="button" class="btn-facebook">
                                    <span class="facebook-icon"></span>
                                    <span>Log in with Facebook</span>
                                </button>
                            </div>
                        </form>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>
                    <div class="box">
                        <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
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
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>