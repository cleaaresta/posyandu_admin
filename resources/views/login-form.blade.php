<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <style>
        body { font-family: Arial; background: #FFD1DC; } /* Pink background */
        .login-box {
            width: 350px;
            margin: 80px auto;
            background: #fff;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #0001;
            position: relative;
        }
        h2 {
            text-align: center;
            color: #d81b60;
            margin-bottom: 20px;
            font-size: 1.4em;
            letter-spacing: 1px;
        }
        .avatar {
            display: block;
            margin: 0 auto 18px auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #f4f4f4;
            box-shadow: 0 2px 8px #0001;
            background-image: url('https://api.dicebear.com/6.x/avataaars/svg?seed=Sophia&gender=femalee'); /* Perempuan */
            background-size: cover;
            background-position: center;
        }
        label {
            font-weight: bold;
            color: #d81b60;
            font-size: 0.95em;
            margin-bottom: 2px;
            display: block;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        button, .cancel-btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 1em;
            cursor: pointer;
        }
        button {
            background: #d81b60;
            color: #fff;
        }
        .cancel-btn {
            background: #c2185b;
            color: #fff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .forgot {
            margin-top: 8px;
            font-size: 0.95em;
        }
        .error {
            color: #d00;
            margin-bottom: 12px;
            text-align: center;
        }
        .checkbox-group {
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>LOGIN FORM</h2>
        <div class="avatar"></div>
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $err)
                    {{ $err }}<br>
                @endforeach
            </div>
        @endif
        <form method="POST" action="/auth/login">
            @csrf
            <label>USERNAME</label>
            <input type="text" name="username" placeholder="Enter Username" value="{{ old('username') }}">
            <label>PASSWORD</label>
            <input type="password" name="password" placeholder="Enter Password">
            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" style="display:inline;font-weight:normal;color:#333;">Ingat Saya</label>
            </div>
            <div class="btn-group">
                <button type="submit">Masuk</button>
                <a href="#" class="cancel-btn">Cancel</a>
            </div>
            <div class="forgot">
                <a href="#">Lupa password?</a>
            </div>
        </form>
    </div>
</body>
</html>