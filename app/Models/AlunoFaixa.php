<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoFaixa extends Model
{
    use HasFactory;

    protected $table = 'aluno_faixas';

    /**
     * Atributos que podem ser preenchidos.
     */
    protected $fillable = [
        'aluno_id',
        'faixa',
        'data_obtencao',
        'grau'
    ];

    /**
     * Relacionamento Inverso: A faixa pertence a um aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}