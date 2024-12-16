<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $query = Curso::query();

        // Aplicar filtros
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Paginação personalizada
        $perPage = $request->get('per_page', 15);
        $cursos = $query->paginate($perPage);

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:on-line,presencial',
            'data_limite' => 'required|date|after:today',
            'vagas_totais' => 'required|integer|min:1',
        ]);

        // Criação do curso
        Curso::create($validated);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:on-line,presencial',
            'data_limite' => 'required|date|after:today',
            'vagas_totais' => 'required|integer|min:1',
        ]);

        // Atualização do curso
        $curso->update($validated);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response()->json(['message' => 'Curso excluído com sucesso.']);
    }

    public function deleteMass(Request $request)
    {
        $request->validate([
            'curso_ids' => 'required|array',
            'curso_ids.*' => 'exists:cursos,id',
        ]);

        Curso::whereIn('id', $request->curso_ids)->delete();

        return redirect()->route('cursos.index')->with('success', 'Cursos excluídos com sucesso!');
    }
}
