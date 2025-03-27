<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'sala_id',
        'usuario_id',
        'data_reserva',
        'hora_inicio',
        'hora_fim',
        'status',
        'chave_usada', // garantir que pode ser preenchido
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
