<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo', 'data_limite', 'vagas_totais'];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'matriculas');
    }
}
