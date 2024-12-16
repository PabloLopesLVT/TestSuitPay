@extends('layouts.layout')

@section('title', 'Gestão de Cursos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Cursos</h1>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary">Adicionar Curso</a>
</div>

<!-- Filtros -->
<form method="GET" action="{{ route('cursos.index') }}" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="nome" class="form-control" placeholder="Filtrar por Nome" value="{{ request('nome') }}">
        </div>
        <div class="col-md-4">
            <select name="tipo" class="form-control">
                <option value="">Filtrar por Tipo</option>
                <option value="on-line" {{ request('tipo') == 'on-line' ? 'selected' : '' }}>On-line</option>
                <option value="presencial" {{ request('tipo') == 'presencial' ? 'selected' : '' }}>Presencial</option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </div>
</form>

<!-- Formulário para deleção em massa -->
<form id="mass-delete-form" method="POST" action="{{ route('cursos.delete-mass') }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Deseja excluir os cursos selecionados?')">Excluir Selecionados</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Data Limite</th>
                <th>Vagas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
            <tr>
                <td><input type="checkbox" name="curso_ids[]" value="{{ $curso->id }}"></td>
                <td>{{ $curso->nome }}</td>
                <td>{{ $curso->tipo }}</td>
                <td>{{ $curso->data_limite }}</td>
                <td>{{ $curso->vagas_totais }}</td>
                <td>
                    <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este curso?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>

<!-- Paginação e seleção de itens por página -->
<div class="d-flex justify-content-between align-items-center">
    <form method="GET" action="{{ route('cursos.index') }}">
        <select name="per_page" class="form-control w-auto d-inline" onchange="this.form.submit()">
            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 por página</option>
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 por página</option>
            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 por página</option>
        </select>
    </form>
    {{ $cursos->withQueryString()->links() }}
</div>

@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="curso_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endpush

@endsection
