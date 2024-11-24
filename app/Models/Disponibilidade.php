<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidade extends Model
{
    use HasFactory;

    protected $table = 'disponibilidades';

    protected $fillable = [
        'sala_id', 'data_inicio', 'data_fim', 'hora_inicio', 'hora_fim'
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
