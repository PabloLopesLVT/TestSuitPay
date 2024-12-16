<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestão de Cursos e Alunos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar .active {
            background-color: #007bff;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <h3 class="p-3 text-center">Menu</h3>
        <a href="{{ route('alunos.index') }}" class="{{ request()->routeIs('alunos.index') ? 'active' : '' }}">Alunos</a>
        <a href="{{ route('cursos.index') }}" class="{{ request()->routeIs('cursos.index') ? 'active' : '' }}">Cursos</a>
        <a href="{{ route('matriculas.index') }}" class="{{ request()->routeIs('matriculas.index') ? 'active' : '' }}">Matrículas</a>
    </div>
    <div class="content">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
