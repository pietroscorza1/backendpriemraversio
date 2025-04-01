<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'membresia_id',
        'tarifa_id',
        'fecha_pago',
        'estado',
    ];

    public function membresia()
    {
        return $this->belongsTo(Membresia::class);
    }

    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class);
    }
}
