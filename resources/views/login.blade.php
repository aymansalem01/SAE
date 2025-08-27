<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: #1e1e1e;
            border: 1px solid #3d3d3d;
            border-radius: 16px;
            padding: 40px 30px;
            width: 360px;
            text-align: center;
            box-shadow: 0 0 20px rgba(255, 209, 0, 0.2);
            transition: 0.3s ease;
        }

        .login-card:hover {
            box-shadow: 0 0 30px rgba(255, 209, 0, 0.4);
        }

        h1 {
            margin-bottom: 15px;
            font-size: 28px;
            color: #ffdd00;
        }

        h3 {
            color: #ffdd00;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        input {
            width: 85%;
            padding: 14px 18px;
            border-radius: 25px;
            border: none;
            outline: none;
            font-size: 16px;
            background-color: #2a2a2a;
            color: #fff;
            transition: 0.2s;
        }

        input:focus {
            box-shadow: 0 0 10px #ffdd00;
        }

        button {
            width: 100%;
            padding: 14px;
            border-radius: 25px;
            border: none;
            background: #ffdd00;
            color: #121212;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        button:hover {
            background: #ffdd00;
            box-shadow: 0 0 12px #ffdd00;
        }

        .chatLogo {
            width: 6rem;
            height: 6rem;
            border-radius: 999px;
            background-color: #ffdd00;
            padding: 2px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div style="display: flex; flex-direction: column; align-items: center">
            <div class="chatLogo">
                <img src={{ asset('assets\image.png') }} alt="" width="90%" />
            </div>
            <div>
                <h1>Welcome to SAE Chatbot</h1>
            </div>
            <h3>Enter Password</h3>
        </div>
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                @if (session('error'))
                    <p style="color: red; margin-top: 5px; font-size: 16px; ">{{ session('error') }}</p>
                @endif
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
