<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conveniencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'icone', // campos da tabela 'conveniencias'
    ];

    // Relacionamento com salas
    public function salas()
    {
        return $this->belongsToMany(Sala::class, 'sala_conveniencias');
    }
}
