<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Producto - ')  }} {{$producto->name }}
        </h2>
    </x-slot>



    <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
        <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
            <img src="/images/{{ $producto->image }}" alt="Reloj" class="w-full h-full object-center object-cover">
        </div>
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8 bg-white rounded">
              <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl pt-2 pl-2">
                Nombre: {{$producto->name}}
              </h1>
              <div class="mt-4 lg:mt-0 lg:row-span-3 pt-2.5 pl-2.5">
                <h2>Informacion de producto</h2>
                <p class="text-3xl text-gray-900">Precio: ${{$producto->price}}</p>
              <div>
              <h3>Descripcion:</h3>
              <div class="space-y-6">
                <p class="text-base text-gray-900">
                    {{$producto->description}}
                </p>
              </div>
              <h3>SKU:</h3>
              <div class="space-y-6">
                <p class="text-base text-gray-900">
                    {{$producto->sku}}
                </p>
              </div>
              <h3>Existencias:</h3>
              <div class="space-y-6">
                <p class="text-base text-gray-900">
                    {{$producto->stock}}
                </p>
              </div>
              <div class="p-6 bg-white border-b border-gray-200 mx-auto">
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$producto->id}}" >
                        <input type="hidden" value="{{ $producto->image }}"  name="image">
                        <input type="hidden" value="1" name="quantity">
                        <input type="submit" name="btn" value="Añadir a carrito" class="text-center border-b rounded-lg text-blue-50 bg-blue-800 mx-auto p-2 shadow hover:text-blue-900 hover:bg-white">
                    </form>
            </div>
            </div>
              </div>
            </div>
    </div>
    <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
        <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block bg-white rounded pt-2.5 pl-2.5 pb-2.5" >
            <h3>Categoria:</h3>
              <div class="space-y-6">
                <p class="text-base text-gray-900">
                    {{ $producto->category->description }}
                </p>
              </div>
         </div>
</x-app-layout>
