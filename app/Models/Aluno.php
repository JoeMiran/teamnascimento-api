<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela (opcional se o nome for o plural do Model)
     */
    protected $table = 'alunos';

    /**
     * Atributos que podem ser preenchidos em massa (Mass Assignment).
     * Devem corresponder exatamente aos nomes das colunas na migration.
     */
    protected $fillable = [
        'matricula',
        'nome',
        'cpf',
        'data_nascimento',
        'sexo',
        'endereco',
        'telefone',
        'responsavel_nome',
        'responsavel_cpf',
        'problemas_saude',
        'plano',
        'status',
    ];

    /**
     * RELACIONAMENTOS
     */

    /**
     * Relacionamento 1 para Muitos: Um aluno possui várias mensalidades.
     */
    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class, 'aluno_id');
    }

    /**
     * Relacionamento 1 para Muitos: Um aluno possui várias faixas no seu histórico.
     */
    public function faixas()
    {
        return $this->hasMany(AlunoFaixa::class, 'aluno_id');
    }

    /**
     * LÓGICA DE NEGÓCIO (Boot)
     */
    protected static function booted()
    {
        /**
         * Evento "creating": Executa antes do aluno ser salvo no banco.
         * Aqui geramos o número de matrícula automático de 6 dígitos.
         */
        static::creating(function ($aluno) {
            do {
                // Gera um número aleatório entre 000001 e 999999
                $numeroMatricula = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
                
                // Verifica se já existe um aluno com esse número para evitar duplicados
            } while (static::where('matricula', $numeroMatricula)->exists());

            $aluno->matricula = $numeroMatricula;
        });
    }

    /**
     * ACESSOR (Opcional)
     * Exemplo: Para formatar a data de nascimento ao exibir
     */
    public function getDataNascimentoFormatadaAttribute()
    {
        return date('d/m/Y', strtotime($this->data_nascimento));
    }
}