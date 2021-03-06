<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    //
    public function index(){
        $id = Auth::id();
        $user = User::find($id);
        $compras = $user->compras;
        return view('productos.compras', ['compras' => $compras]);
    }
}
