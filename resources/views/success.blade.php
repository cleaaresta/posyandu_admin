<!DOCTYPE html>
<html>
<head>
    <title>Login Berhasil</title>
    <style>
        body { font-family: Arial; background: #FFD1DC;} /* Pink background */
        .box {
            width: 350px;
            margin: 80px auto;
            background: #fff;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #0001;
            text-align: center;
            position: relative;
        }
        h2 { color: #d81b60; margin-bottom: 18px; }
        .avatar {
            display: block;
            margin: 0 auto 18px auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #f4f4f4;
            box-shadow: 0 2px 8px #0001;
            background-image: url('https://api.dicebear.com/6.x/avataaars/svg?seed=Sophia&gender=female'); /*Avatar Image*/
            background-size: cover;
            background-position: center;
        }
        .welcome {
            font-size: 1.1em;
            color: #d81b60;
            margin-top: 12px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login Berhasil!</h2>
        <div class="avatar"></div>
        <p class="welcome">Selamat datang, <b>{{ $username }}</b>.</p>
    </div>
</body>
</html>