<!-- FILE: login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Resume Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #bc5e38 0%, #bc5e38 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 450px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #bc5e38 0%, #bc5e38 100%);
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            margin-top: 20px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: white;
        }
        .alert {
            display: none;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2>Resume Admin Login</h2>
            <p>Login to edit your resume</p>
        </div>
        
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            Invalid credentials. Try "admin" / "password123"
            <button type="button" class="btn-close" onclick="hideError()"></button>
        </div>
        
        <form id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            
            <button type="submit" class="btn btn-login">Login</button>
        </form>
        
    </div>

    <script src="js/auth.js"></script>
    <script>
        function showRegister() {
            alert('Registration is disabled for demo. Use: admin / password123');
        }
        
        function hideError() {
            document.getElementById('errorAlert').style.display = 'none';
        }
    </script>
</body>
</html>