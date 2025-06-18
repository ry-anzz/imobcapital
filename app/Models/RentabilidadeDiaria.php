<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentabilidadeDiaria extends Model
{
 protected $fillable = [
    'data_referencia',
    'rentabilidade_percentual',
    'obs',
];

}
