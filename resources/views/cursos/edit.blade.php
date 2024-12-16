@extends('layouts.layout')

@section('title', 'Editar Curso')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Curso</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cursos.update', $curso) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Curso</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $curso->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="on-line" {{ old('tipo', $curso->tipo) == 'on-line' ? 'selected' : '' }}>On-line</option>
                <option value="presencial" {{ old('tipo', $curso->tipo) == 'presencial' ? 'selected' : '' }}>Presencial</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_limite" class="form-label">Data Limite</label>
            <input type="date" class="form-control" id="data_limite" name="data_limite" value="{{ old('data_limite', $curso->data_limite) }}" required>
        </div>

        <div class="mb-3">
            <label for="vagas_totais" class="form-label">Número de Vagas</label>
            <input type="number" class="form-control" id="vagas_totais" name="vagas_totais" value="{{ old('vagas_totais', $curso->vagas_totais) }}" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
