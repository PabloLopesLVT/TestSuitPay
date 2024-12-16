<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        // Lista todos os cursos com seus alunos matriculados
        $matriculas = Curso::with('alunos')->get();

        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        // Lista todos os alunos e cursos disponíveis
        $alunos = Aluno::all();
        $cursos = Curso::all();

        return view('matriculas.create', compact('alunos', 'cursos'));
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        $curso = Curso::findOrFail($validated['curso_id']);
        $aluno = Aluno::findOrFail($validated['aluno_id']);

        // Verificar se a matrícula está dentro da data limite
        if (now()->greaterThan($curso->data_limite)) {
            return redirect()->back()->withErrors(['message' => 'Matrículas encerradas para este curso.']);
        }

        // Verificar se há vagas disponíveis no curso
        if ($curso->alunos()->count() >= $curso->vagas_totais) {
            return redirect()->back()->withErrors(['message' => 'Vagas esgotadas para este curso.']);
        }

        // Verificar se o aluno já está matriculado neste curso
        if (
            $curso
                ->alunos()
                ->where('matriculas.curso_id', $curso->id)
                ->where('alunos.id', $aluno->id)
                ->exists()
        ) {
            return redirect()->back()->withErrors(['message' => 'Este aluno já está matriculado neste curso.']);
        }

        // Criar a matrícula
        $curso->alunos()->attach($aluno);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula realizada com sucesso!');
    }

    public function destroy($curso_id, $aluno_id)
    {
        // Localizar curso e aluno
        $curso = Curso::findOrFail($curso_id);
        $aluno = Aluno::findOrFail($aluno_id);

        // Remover a matrícula
        $curso->alunos()->detach($aluno);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula removida com sucesso!');
    }
}
