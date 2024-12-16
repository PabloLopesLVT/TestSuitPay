@extends('layouts.layout')

@section('title', 'Lista de Alunos')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Alunos</h1>
        <a href="{{ route('alunos.create') }}" class="btn btn-primary">Adicionar Novo Aluno</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('alunos.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="nome" class="form-control" placeholder="Filtrar por Nome" value="{{ request('nome') }}">
            </div>
            <div class="col-md-4">
                <input type="email" name="email" class="form-control" placeholder="Filtrar por E-mail" value="{{ request('email') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>

    <!-- Tabela de Alunos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->id }}</td>
                    <td>{{ $aluno->nome }}</td>
                    <td>{{ $aluno->email }}</td>
                    <td>{{ $aluno->telefone }}</td>
                    <td>
                        <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este aluno?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum aluno encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="d-flex justify-content-between align-items-center">
        <form method="GET" action="{{ route('alunos.index') }}">
            <select name="per_page" class="form-control w-auto d-inline" onchange="this.form.submit()">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 por página</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 por página</option>
                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 por página</option>
            </select>
        </form>
        {{ $alunos->withQueryString()->links() }}
    </div>
</div>
@endsection
