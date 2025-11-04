<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plano extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'valor',
        'periodicidade',
    ];

    /**
     * Define os tipos de atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'valor' => 'decimal:2', // Converte para decimal com 2 casas
    ];

    /**
     * Um Plano tem muitas Matrículas.
     */
    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class, 'id_plano');
    }
}