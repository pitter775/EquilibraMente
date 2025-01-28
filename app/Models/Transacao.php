<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $fillable = [
        'usuario_id',
        'sala_id',
        'pagbank_order_id',
        'reference_id',
        'valor',
        'status',
        'detalhes',
    ];

    protected $casts = [
        'detalhes' => 'array', // Para armazenar JSON no banco
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }
}
