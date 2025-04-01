<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PagoAdministrador extends Model
{
    use HasFactory;

    protected $table = 'pago_administrador';
    protected $fillable = ['fecha_pago', 'membresia_id', 'importe'];

    // Relación con Membresia
    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }
}
