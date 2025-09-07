<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #6d5dfc;
            color: #fff;
            padding: 15px 20px;
            border-radius: 10px;
        }
        .logout-btn {
            background: #ff4d4d;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Dashboard</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="content">
        <h3>Selamat datang, {{ Auth::user()->name }}!</h3>
        <p>Ini adalah halaman dashboard setelah login.</p>
    </div>
</body>
</html>
