<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $fillable = ['user_id', 'tipo', 'valor', 'descricao'];
}
