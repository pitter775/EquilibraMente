<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'tipo_usuario', 
        'cpf', 
        'sexo', 
        'idade', 
        'telefone',
        'cadastro_completo',
        'registro_profissional', 
        'tipo_registro_profissional', 
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relacionamento com reservas
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'usuario_id');
    }

    public function contratos()
    {
        return $this->hasMany(\App\Models\ContratoUsuario::class);
    }

    /**
     * Relacionamento polimórfico com endereço
     */
    public function endereco(): MorphOne
    {
        return $this->morphOne(Endereco::class, 'enderecavel');
    }
}

