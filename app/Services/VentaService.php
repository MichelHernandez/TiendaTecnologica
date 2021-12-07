<?php

namespace App\Services;

use App\Models\Venta;
use App\Models\Product;
use App\Models\VentaItem;

class VentaService
{
    public static function storeVenta($items, $userId){
        $total = 0;
        $venta = new Venta([
            'user_id' => $userId,
            'total' => $total
        ]);
        $venta->save();
        foreach($items as $item){
            $producto = Product::findOrFail($item->id);
            if($producto->stock < $item->quantity){
                $venta->delete();
                return "ERROR! Stock insuficiente del producto " . $item->name;
            }
            $ventaItem = new VentaItem([
                'cantidad' => $item->quantity,
                'precio' => $item->price,
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
            ]);
            $ventaItem->save();
            
            $total = $total + $item->price * $item->quantity;

            $producto->stock = $producto->stock - $item->quantity;
            $producto->save();
        }
        $venta->total = $total;
        $venta->save();
    }

    private function storeItem(){

    }
}