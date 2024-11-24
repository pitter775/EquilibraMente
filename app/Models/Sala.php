<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';

    protected $fillable = [
        'nome', 'descricao', 'valor', 'status'
    ];

    public function endereco()
    {
        return $this->morphOne(Endereco::class, 'enderecavel');
    }

    

    public function disponibilidades()
    {
        return $this->hasMany(Disponibilidade::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
    public function imagens()
    {
        return $this->hasMany(ImagemSala::class, 'sala_id');
    }

    // Relacionamento com conveniências
    public function conveniencias()
    {
        return $this->belongsToMany(Conveniencia::class, 'sala_conveniencias');
    }

    
}
