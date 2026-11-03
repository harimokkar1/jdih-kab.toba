<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login JDIH</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        background: url('/logo.png') no-repeat center center fixed;
        background-size: 1000px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* overlay biar tidak terlalu kontras */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background: rgba(13, 110, 253, 0.7); /* biru transparan */
        z-index: -1;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.15); /* transparan */
        backdrop-filter: blur(10px); /* efek kaca */
        -webkit-backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    .login-card .card-body {
        padding: 35px;
    }

    .login-title {
        font-weight: 600;
        color: #fff;
    }

    .logo-text {
        color: #e0e0e0;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        background: rgba(255,255,255,0.8);
        border: none;
    }

    .form-control:focus {
        box-shadow: none;
        border: none;
    }

    .btn-login {
        border-radius: 8px;
        padding: 10px;
        font-weight: 500;
        background-color: #ffffff;
        color: #0d6efd;
        border: none;
    }

    .btn-login:hover {
        background-color: #e2e6ea;
    }

    .footer-text {
        font-size: 12px;
        color: #ddd;
    }

    .alert {
        background: rgba(255, 0, 0, 0.2);
        border: none;
        color: #fff;
    }
</style>
</head>

<body>

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">

        <div class="col-md-4">

            <div class="card shadow login-card">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <h5 class="logo-text">Sistem Informasi</h5>
                        <h4 class="login-title">JDIH Kabupaten TOBA</h4>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-login w-100">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3 footer-text">
                        © 2026 Kominfo
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>