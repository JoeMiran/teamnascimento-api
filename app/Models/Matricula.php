<?php

namespace App\Models;

// 1. Certifica-te que esta linha "use" está presente
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    // 2. Adiciona esta linha DENTRO da classe
    use HasFactory;

    /**
     * O resto do teu código do modelo continua aqui...
     * (por exemplo: $fillable, $casts, relações, etc.)
     */
}