<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'cpf',
        'endereco',
        'data_nascimento',
        'faixa',
        'id_status',
    ];

    /**
     * Define os tipos de atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_nascimento' => 'date', // Converte para um objeto Carbon (data)
    ];

    /**
     * Um Aluno pertence a um Status (Adimplente, Inadimplente, etc.).
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusAluno::class, 'id_status');
    }

    /**
     * Um Aluno pode ter várias Matrículas (histórico).
     */
    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class, 'id_aluno');
    }
}