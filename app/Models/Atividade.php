<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = ['id_usuario', 'descricao', 'hora_inicio', 'hora_fim'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
