{{-- filepath: resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <style>
        body {
            background: #f4f6fb;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 2.5rem 2rem 2rem 2rem;
            width: 100%;
            max-width: 350px;
            text-align: center;
        }
        .card h1 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
            font-size: 1.6rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 0.3rem;
            color: #34495e;
            font-size: 0.98rem;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            background: #f8fafc;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #4f8cff;
            outline: none;
        }
        .error {
            color: #e74c3c;
            margin-bottom: 1rem;
            font-size: 0.97rem;
        }
        button {
            background: #4f8cff;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.7rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background 0.2s;
        }
        button:hover {
            background: #2563eb;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Iniciar sesión</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre de usuario:</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" name="password" required>
            </div>
            @if ($errors->any())
                <div class="error">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>