<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investimento extends Model
{
    protected $fillable = [
        'user_id',
        'valor',
        'prazo_dias',
        'rentabilidade_percentual',
        'data_inicio',
        'data_vencimento',
        'valor_estimado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
