<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            flex-wrap: nowrap;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            padding-top: 20px;
            transition: all 0.3s;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            transition: all 0.3s;
        }

        .content.expanded {
            margin-left: 0;
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background-color: #343a40;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }

        .toggle-btn:hover {
            background-color: #495057;
        }
    </style>
</head>

<body>
    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggleSidebar">☰</button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-center">Sistem Pengarsipan</h4>
        <hr>
        <a href="/admin">Dashboard</a>
        <a href="/admin/mahasiswa">Mahasiswa</a>
        <a href="/admin/arsip">Arsip</a>
        <a href="/admin/kategori">Kategori</a>
        <a href="/logout" class="text-danger">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-people-fill display-1 text-success"></i>
                        <h5 class="card-title mt-3">Manage Mahasiswa</h5>
                        <p class="card-text">Kelola data mahasiswa.</p>
                        <a href="/admin/mahasiswa" class="btn btn-success">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-folder-fill display-1 text-warning"></i>
                        <h5 class="card-title mt-3">Manage Arsip</h5>
                        <p class="card-text">Kelola data arsip.</p>
                        <a href="/admin/arsip" class="btn btn-warning">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-tags-fill display-1 text-primary"></i>
                        <h5 class="card-title mt-3">Manage Kategori Arsip</h5>
                        <p class="card-text">Kelola kategori arsip.</p>
                        <a href="/admin/kategori" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        const toggleSidebarButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleSidebarButton.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('expanded');
        });
    </script>
</body>

</html>