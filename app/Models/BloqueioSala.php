<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloqueioSala extends Model
{
    use HasFactory;

    protected $table = 'bloqueios_salas';

    protected $fillable = [
        'sala_id',
        'data_inicio',
        'data_fim',
        'hora_inicio',
        'hora_fim',
        'tipo',
        'motivo',
        'ativo',
        'created_by',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativo' => 'boolean',
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function criador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
