<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';
    
    const STATUS_PENDENTE = 'PENDING';
    const STATUS_PAGA = 'PAID';
    const STATUS_CANCELADA = 'CANCELLED';

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

    // Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Accessors
    public function getValorFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->valor, 2, ',', '.');
    }

    // Escopos
    public function scopePagas($query)
    {
        return $query->where('status', self::STATUS_PAGA);
    }

    public function scopePendentes($query)
    {
        return $query->where('status', self::STATUS_PENDENTE);
    }

    // Eventos do Modelo
    protected static function booted()
    {
        static::creating(function ($transacao) {
            if (!$transacao->status) {
                $transacao->status = self::STATUS_PENDENTE;
            }
        });
    }
}
