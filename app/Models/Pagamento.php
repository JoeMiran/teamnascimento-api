<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamento extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_matricula',
        'id_status_pagamento',
        'data_vencimento',
        'data_pagamento',
        'valor_cobrado',
        'valor_pago',
        'referencia_mes',
        'referencia_ano',
    ];

    /**
     * Define os tipos de atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'valor_cobrado' => 'decimal:2',
        'valor_pago' => 'decimal:2',
    ];

    /**
     * Um Pagamento pertence a uma Matrícula.
     */
    public function matricula(): BelongsTo
    {
        return $this->belongsTo(Matricula::class, 'id_matricula');
    }

    /**
     * Um Pagamento pertence a um Status de Pagamento (Pendente, Pago, etc.).
     */
    public function status(): BelongsTo
    {
        // Renomeamos a função para 'status' para ser mais limpo de usar.
        return $this->belongsTo(StatusPagamento::class, 'id_status_pagamento');
    }
}