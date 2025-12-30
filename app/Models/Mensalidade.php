<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    use HasFactory;

    protected $table = 'mensalidades';

    /**
     * Atributos que podem ser preenchidos.
     * Devem bater com a sua migration de mensalidades.
     */
    protected $fillable = [
        'aluno_id',
        'valor_vencimento',
        'valor_pago',
        'data_vencimento',
        'data_pagamento',
        'status',
        'mes_referencia'
    ];

    /**
     * Relacionamento Inverso: A mensalidade pertence a um aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}