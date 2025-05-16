<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoUsuario extends Model
{
    protected $table = 'contratos_usuarios';
    
    protected $fillable = [
        'user_id',
        'versao_contrato',
        'aceito_em',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
