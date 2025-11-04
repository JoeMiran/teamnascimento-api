<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusPagamento extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'status_pagamentos';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rotulo',
    ];

    /**
     * Um Status de Pagamento pode pertencer a muitos Pagamentos.
     */
    public function pagamentos(): HasMany
    {
        return $this->hasMany(Pagamento::class, 'id_status_pagamento');
    }
}