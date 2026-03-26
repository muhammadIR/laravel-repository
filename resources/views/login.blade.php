<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    * { box-sizing: border-box; margin:0; padding:0; font-family: Arial, sans-serif; }
    body, html {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #ffffff 0%, #e6e6e6 100%);
    }

    .login-container {
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .login-container .input-group { position: relative; margin-bottom: 20px; }
    .login-container input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        transition: 0.3s all;
    }
    .login-container input:focus {
        border-color: #999;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        outline: none;
    }

    .login-container .input-group i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
    }

    .login-container .checkbox-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .login-container button {
        width: 100%;
        padding: 12px;
        background: #999;
        border: none;
        border-radius: 8px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s all;
    }
    .login-container button:hover {
        background: #777;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .error-message {
        color: #ff4d4f;
        margin-bottom: 15px;
        text-align: center;
    }

    .forgot-link {
        font-size: 14px;
        text-decoration: none;
        color: #555;
    }
    .forgot-link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group">
            <input type="text" name="email" placeholder="Email" required>
            <i class="fa fa-envelope"></i>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" id="password" required>
            <i class="fa fa-eye" onclick="togglePassword()"></i>
        </div>

        <div class="checkbox-group">
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
            <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = event.target;
        if(password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>