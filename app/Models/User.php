<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'codigo_convite',
        'password',
        'saldo',
        'indicador_id',
        'nivel', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    'reset_code_created_at' => 'datetime',
];


public function investimentos()
{
    return $this->hasMany(\App\Models\Investimento::class, 'user_id');
}


    public function indicador()
{
    return $this->belongsTo(User::class, 'indicador_id');
}

public function indicados()
{
    return $this->hasMany(User::class, 'indicador_id');
}

}
