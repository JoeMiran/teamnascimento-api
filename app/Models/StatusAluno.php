<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusAluno extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     * (O Laravel adivinha 'status_alunos', mas é bom ser explícito)
     *
     * @var string
     */
    protected $table = 'status_alunos';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rotulo',
    ];

    /**
     * Um Status de Aluno pode pertencer a muitos Alunos.
     */
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class, 'id_status');
    }
}