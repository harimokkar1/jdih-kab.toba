<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { margin: 0; }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #0d6efd;
            color: white;
            position: fixed;
        }

        .sidebar h4 { padding: 20px; }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar-custom {
            background: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>JDIH</h4>

    <a href="#">Dashboard</a>

    <form method="POST" action="/logout" class="mt-3 px-3">
        @csrf
        <button class="btn btn-light w-100">Logout</button>
    </form>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="navbar-custom mb-3">
        <strong>Super Admin Panel</strong>
    </div>

    <h4>Kelola Admin</h4>

    <div class="row mt-4">

        <!-- FORM -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">

                    <h5>Tambah Admin</h5>

                    <form method="POST" action="/admin/store">
                        @csrf

                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100 mt-2">Simpan</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- TABEL -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">

                    <h5>Data Admin</h5>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <form method="POST" action="/admin/delete/{{ $admin->id }}">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if($admins->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Belum ada admin</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>