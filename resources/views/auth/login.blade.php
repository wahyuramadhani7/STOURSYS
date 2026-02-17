<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — SToursys Borobudur</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #f5f4f0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .login-box {
            background: #fff;
            border-radius: 16px;
            padding: 40px 36px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand-logo { font-size: 28px; margin-bottom: 8px; }
        .brand-name { font-size: 20px; font-weight: 600; color: #1a1a1a; letter-spacing: .04em; }
        .brand-sub  { font-size: 13px; color: #9b8b6e; margin-top: 4px; }

        .status-msg {
            background: #f0f7f0;
            border: 1px solid #b5d8b5;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #3a7a3a;
            margin-bottom: 20px;
        }

        .field { margin-bottom: 18px; }
        .field label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #444;
            margin-bottom: 6px;
        }
        .field input[type="email"],
        .field input[type="password"] {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e2dc;
            border-radius: 10px;
            font-size: 14.5px;
            font-family: inherit;
            color: #1a1a1a;
            background: #fafaf8;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field input:focus {
            border-color: #b07d3a;
            box-shadow: 0 0 0 3px #b07d3a18;
            background: #fff;
        }
        .field-error { font-size: 12px; color: #d05050; margin-top: 5px; }

        .extras {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #666;
            cursor: pointer;
        }
        .remember input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: #b07d3a;
            cursor: pointer;
        }
        .forgot { font-size: 13px; color: #b07d3a; text-decoration: none; }
        .forgot:hover { text-decoration: underline; }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #b07d3a;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14.5px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .1s;
        }
        .btn-submit:hover  { background: #9a6a2a; }
        .btn-submit:active { transform: scale(.99); }

        .footer-text {
            text-align: center;
            font-size: 12px;
            color: #c0b090;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="login-box">

        <div class="brand">
            <div class="brand-logo">🏛️</div>
            <div class="brand-name">SToursys</div>
            <div class="brand-sub">Smart Tourism · Borobudur</div>
        </div>

        @if (session('status'))
            <div class="status-msg">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       placeholder="nama@email.com" required autofocus autocomplete="username" />
                @if ($errors->has('email'))
                    <div class="field-error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password"
                       placeholder="••••••••" required autocomplete="current-password" />
                @if ($errors->has('password'))
                    <div class="field-error">{{ $errors->first('password') }}</div>
                @endif
            </div>

          

            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <div class="footer-text">Kawasan Warisan Dunia UNESCO · Magelang</div>

    </div>
</body>
</html>