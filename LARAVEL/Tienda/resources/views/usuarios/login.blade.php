<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            max-width: 400px;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .login-container img {
            display: block;
            margin: 0 auto 1.5rem;
            width: 150px;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-outline-secondary {
            width: 100%;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 0.875rem;
            color: #e74c3c;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <img src="{{asset('img/landscape.jpg')}}" alt="Logo">
            <form action="{{route('loguear')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    @error('email')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ps" class="form-label">Contraseña</label>
                    <input type="password" name="ps" id="ps" class="form-control">
                    @error('ps')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-outline-secondary">Iniciar sesión</button>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{route('vistaRegistro')}}" class="btn btn-outline-secondary">Registrarse</a>
                    @if (session('mensaje'))
                        <p class="text-center text-success">{{ session('mensaje') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

</body>
</html>
