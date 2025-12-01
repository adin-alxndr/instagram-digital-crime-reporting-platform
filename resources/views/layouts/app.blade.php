<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Digital Forensik System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    @include('layouts.header')

    <div class="main-content">
        <div class="container-fluid w-100">
            <div class="row h-100">
                <!-- Sidebar -->
                <div class="col-md-2 sidebar p-3">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" 
                               href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ Route::is('incidents.*') ? 'active' : '' }}" 
                               href="{{ route('incidents.index') }}">
                                <i class="fas fa-exclamation-triangle me-2"></i>Insiden
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ Route::is('victims.*') ? 'active' : '' }}" 
                               href="{{ route('victims.index') }}">
                                <i class="fas fa-users me-2"></i>Korban
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ Route::is('evidence.*') ? 'active' : '' }}" 
                               href="{{ route('evidence.index') }}">
                                <i class="fas fa-archive me-2"></i>Barang Bukti
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="col-md-10 p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>