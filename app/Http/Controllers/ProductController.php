<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\RolService;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a the welcome view with products.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $productos = Product::all();
        return view('welcome', ['productos' => $productos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve the currently authenticated user's ID...
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $productos = Product::all();
            return view('productos.index', ['productos' => $productos]);
        }
        else{
            $productos = Product::all();
            return view('productos.public-index', ['productos' => $productos]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $categories = Category::all();
            return view('productos.create', ['categories' => $categories]);
        }
        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $validated = $request->validate([
                'productname' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'sku' => ['required', 'string', 'max:255', 'unique:products,sku'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'integer'],
                'image' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg'],
                'category' => ['string', 'max:255'],
                'add_category' => ['nullable','string', 'max:255'],
                'new_category' => ['string', 'max:255'],
            ]);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
            }else {
                $name = 'default.png';
            }

            $producto = new Product();
            $producto->description = Str::ucfirst($validated['description']);
            $producto->name = Str::ucfirst($validated['productname']);
            $producto->sku = $validated['sku'];
            $producto->price = $validated['price'];
            $producto->stock = $validated['stock'];
            $producto->image = $name;

            if (!$request->has('category')) {
                $cat = Str::ucfirst($validated['add_category']);
            }else if($request->has('new_category')){
                $cat = Str::ucfirst($validated['add_category']);
            }else {
                $cat = Str::ucfirst($validated['category']);
            }

            $category = Category::firstOrNew([
                'description' => $cat
            ]);
            $category->save();
            $producto->category()->associate($category);
            $producto->save();

            return redirect()->route('productos-create')->with('status', 'Se ha creado el nuevo producto');
            // return redirect('dashboard')->with('status', 'Profile updated!');

        }
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $producto = Product::findOrFail($id);
            return view('productos.show', ['producto' => $producto]);
        }
        else{
            $producto = Product::findOrFail($id);
            return view('productos.show-public', ['producto' => $producto]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $categories = Category::all();
            $producto = Product::findOrFail($id);
            return view('productos.edit', ['producto' => $producto, 'categories' => $categories]);
        }
        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $producto = Product::findOrFail($id);
            $producto->sku = $request->input('sku');
            if($producto->isDirty('sku')){
                $validated = $request->validate([
                    'productname' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255'],
                    'sku' => ['required', 'string', 'max:255', 'unique:products,sku'],
                    'price' => ['required', 'numeric'],
                    'stock' => ['required', 'integer'],
                    'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg'],
                    'category' => ['string', 'max:255'],
                    'add_category' => ['nullable','string', 'max:255'],
                    'new_category' => ['string', 'max:255'],
                ]);
            }else {
                $validated = $request->validate([
                    'productname' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255'],
                    'sku' => ['required', 'string', 'max:255'],
                    'price' => ['required', 'numeric'],
                    'stock' => ['required', 'integer'],
                    'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg'],
                    'category' => ['string', 'max:255'],
                    'add_category' => ['nullable','string', 'max:255'],
                    'new_category' => ['string', 'max:255'],
                ]);
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $producto->image = $name;
            }
            
            $producto->description = Str::ucfirst($validated['description']);
            $producto->name = Str::ucfirst($validated['productname']);
            $producto->sku = $validated['sku'];
            $producto->price = $validated['price'];
            $producto->stock = $validated['stock'];
    
            if (!$request->has('category')) {
                $cat = Str::ucfirst($validated['add_category']);
            }else if($request->has('new_category')){
                $cat = Str::ucfirst($validated['add_category']);
            }else {
                $cat = Str::ucfirst($validated['category']);
            }

            $category = Category::firstOrNew([
                'description' => $cat
            ]);
            $category->save();
            $producto->category()->associate($category);
            $producto->save();

            return redirect()->route('productos-show', ['id' => $producto->id])->with('status', 'Se ha Actualizado este producto');
        }
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::id();
        if(RolService::verifyIsAdmin($user)){
            $producto = Product::findOrFail($id);
            $producto->delete();
            return redirect()->route('productos-index')->with('error', 'Se ha Eliminado el producto');
        }
        return redirect()->route('dashboard');
    }
}
