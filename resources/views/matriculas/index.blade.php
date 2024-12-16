@extends('layouts.layout')

@section('title', 'Lista de Matrículas')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Matrículas</h1>
        <a href="{{ route('matriculas.create') }}" class="btn btn-primary">Nova Matrícula</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Aluno</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matriculas as $curso)
                @foreach ($curso->alunos as $aluno)
                    <tr>
                        <td>{{ $curso->nome }}</td>
                        <td>{{ $aluno->nome }}</td>
                        <td>
                            <form action="{{ route('matriculas.destroy', [$curso->id, $aluno->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja remover esta matrícula?')">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nenhuma matrícula encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
