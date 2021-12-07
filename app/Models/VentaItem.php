<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaItem extends Model
{
    use HasFactory;

    protected $table = 'ventas_item';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidad',
        'precio',
        'venta_id',
        'producto_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Product::class, 'producto_id', 'id');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id', 'id');
    }
}
