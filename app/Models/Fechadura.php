<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fechadura extends Model
{
    protected $fillable = [
        'sala_id',
        'tipo',
        'chaves',
    ];

    protected $casts = [
        'chaves' => 'array',
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
