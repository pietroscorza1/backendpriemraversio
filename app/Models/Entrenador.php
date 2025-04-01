<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected $primaryKey = 'entrenador_id';

    protected $fillable = [
        'especialidad',
        'experiencia',
        'disponibilidad',
        'phone_number',
        'certificaciones',
        'descripcion',
    ];
}
