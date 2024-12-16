<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = ['curso_id', 'aluno_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
