<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios'; // Nombre correcto de la tabla

    protected $fillable = [
        'clase_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    // Relación con Clase
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'clase_id');
    }
}
