<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnicos extends Model
{
    protected $table = 'tecnicos';

    protected $fillable = [
        'nombre',
        'especialidad',
    ];
}
