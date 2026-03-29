<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Silsilah Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        body.sb-sidenav-toggled #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            body.sb-sidenav-toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }

        .nav-link:hover {
            background: #34495e;
            color: white !important;
        }

        .active-link {
            background: #34495e;
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white border-end" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-dark">
                <i class="bi bi-diagram-3-fill me-2"></i>Silsilah Keluarga
            </div>
            <div class="list-group list-group-flush">
                <a href="/" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                    <i class="bi bi-house-door me-2"></i>Dashboard
                </a>
                <a href="/anggota" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                    <i class="bi bi-people me-2"></i>Daftar Anggota
                </a>
                <a href="/pohon" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                    <i class="bi bi-tree me-2"></i>Pohon Keluarga
                </a>
                <a href="/anggota/tambah" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                    <i class="bi bi-person-plus me-2"></i>Tambah Anggota
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary btn-sm" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="ms-auto">
                        <span class="text-muted small">Tahun Pelacakan: 2026</span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid py-4">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk toggle sidebar
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }
        });
    </script>
</body>

</html>