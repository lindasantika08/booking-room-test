<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset("images/bg.jpg") }}') no-repeat center center/cover;
            position: relative;
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(2px);
        }

        .login-box {
            position: relative;
            z-index: 10;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
        }

        .login-box input {
            width: 93%;
            padding: 10px 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #6d5dfc;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            margin-top: 12px;
            transition: background 0.3s;
        }

        .login-btn:hover {
            background: #5748d6;
        }

        .login-box p {
            margin-top: 14px;
            font-size: 13px;
            text-align: center;
        }

        .login-box p a {
            color: #6d5dfc;
            text-decoration: none;
            font-weight: 600;
        }

        .login-box p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a>.</p>
    </div>
</body>
</html>
