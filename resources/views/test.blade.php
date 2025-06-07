<!DOCTYPE html>
<html>
<head>
    <title>Test Profile</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Auth API</h1>
    
    <div>
        <h3>Register</h3>
        <form id="registerForm">
            <input type="text" id="username" placeholder="Username" required><br>
            <input type="email" id="email" placeholder="Email" required><br>
            <input type="password" id="password" placeholder="Password" required><br>
            <input type="password" id="password_confirmation" placeholder="Confirm Password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>

    <div>
        <h3>Login</h3>
        <form id="loginForm">
            <input type="email" id="loginEmail" placeholder="Email" required><br>
            <input type="password" id="loginPassword" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>

    <div id="result"></div>

    <script>
        // Register
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: document.getElementById('name').value,
                    username: document.getElementById('username').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('password_confirmation').value,
                })
            });
            
            const data = await response.json();
            document.getElementById('result').innerHTML = JSON.stringify(data, null, 2);
        });

        // Login
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: document.getElementById('loginEmail').value,
                    password: document.getElementById('loginPassword').value,
                })
            });
            
            const data = await response.json();
            document.getElementById('result').innerHTML = JSON.stringify(data, null, 2);
        });
    </script>
</body>
</html>