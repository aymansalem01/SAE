<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Portal - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-dark: #020617;
            --card-bg: #0f172a;
            /* Original Indigo/Purple Theme */
            --primary-accent: #6366f1;
            --secondary-accent: #8b5cf6;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.15);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-dark);
            min-height: 100vh;
            color: var(--text-main);
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Ambient Background - Cool Tones */
        .ambient-light {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background: radial-gradient(circle at 50% -20%, #1e1b4b, #020617 60%);
        }

        /* Card Style */
        .card-panel {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.05), 0 20px 40px -10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
        }

        /* Inputs */
        .login-input {
            background: #1e293b !important;
            border: 1px solid var(--border-color);
            color: #fff !important;
            padding: 12px 16px;
            font-size: 1rem;
        }
        .login-input:focus {
            background: #1e293b !important;
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        }
        .login-input::placeholder { color: #64748b; }

        .login-label {
            color: var(--text-main);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        /* Buttons */
        .btn-primary-gradient {
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: opacity 0.2s;
            text-align: center;
            display: block;
            text-decoration: none;
        }
        .btn-primary-gradient:hover {
            opacity: 0.9;
            color: white;
        }
    </style>
</head>
<body>

    <div class="ambient-light"></div>

    <div class="card-panel p-5">
        <div class="text-center ">
            <div class="d-inline-flex align-items-center justify-content-center bg-opacity-10 rounded-3 mb-2" style="width: 200px;height:100px">
                <img src="{{ asset('assets/ltuc.png') }}" alt="" width="100%" >
            </div>
            <h3 class="fw-bold ">MR.X Chatbot</h3>
            <p class="mt-2 mb-3" >Enter your credentials to access the workspace.</p>
        </div>

        <form action=" {{ route('login') }} " method="post" >
            @csrf
            <div class="mb-4">
                <label class="login-label">Email Address</label>
                <input type="email" class="form-control login-input" name="email" placeholder="e.g. name@company.com" value="{{ old('email') }}" >
                @error('email')
                <p style="color: red" >{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between">
                    <label class="login-label">Password</label>
                    <a href="#" class="text-primary text-decoration-none small">Forgot Password?</a>
                </div>
                <input type="password" name="password" class="form-control login-input" placeholder="Enter your password" >
                @error('password')
                <p style="color: red"> {{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="btn-primary-gradient mt-4">
                Sign In to Portal
            </button>


        </form>
    </div>

</body>
</html>
