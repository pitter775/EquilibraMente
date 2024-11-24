<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';

    protected $fillable = [
        'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
    ];

    public function enderecavel(): MorphTo
    {
        return $this->morphTo();
    }
}
