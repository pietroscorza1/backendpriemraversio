<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    /** @use HasFactory<\Database\Factories\ClaseFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_entrenador',
        'maximo_participantes',
    ];
    public function entrenador()
    {
        return $this->belongsTo(User::class, 'id_entrenador');
    }

    // Relación many-to-many con los participantes (usuarios)
    public function participantes()
    {
        return $this->belongsToMany(User::class, 'clase_user');
    }

    // Relación con los horarios (1 a muchos)
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
