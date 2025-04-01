<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tarifas';
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'meses',
    ];


    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
