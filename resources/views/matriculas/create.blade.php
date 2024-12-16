@extends('layouts.layout')

@section('title', 'Nova Matrícula')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Nova Matrícula</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('matriculas.store') }}">
        @csrf

        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select class="form-control" id="aluno_id" name="aluno_id" required>
                <option value="">Selecione um aluno</option>
                @foreach ($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select class="form-control" id="curso_id" name="curso_id" required>
                <option value="">Selecione um curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Matrícula</button>
        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
