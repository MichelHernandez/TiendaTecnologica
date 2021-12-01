<x-app-layout>
    <script>
        function changeCategoryOpt(){
            let check = document.getElementById('new_category');
            let addCcategory = document.getElementById('add_category');

            if(check.checked){
                document.getElementById('category').disabled = true;
                document.getElementById('add_category').disabled = false;
            }else{
                document.getElementById('category').disabled = false;
                document.getElementById('add_category').disabled = true;
            }
        }
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar productos') }}
        </h2>
    </x-slot>

    <div class="py-7 mx-auto">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-session-status class="mb-4 text-green-700" :status="session('status')" />
                    <x-auth-session-status class="mb-4 text-red-700" :status="session('error')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    Rellena el formulario para agregar un producto nuevo a tu catálogo
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('productos-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 lg:col-span-3">
                                        <label for="productname" class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <input type="text" name="productname" id="productname" autocomplete="productname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" max="255" required>
                                    </div>
                                    <div class="col-span-6 lg:col-span-3">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                        <input type="text" name="description" id="description" autocomplete="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" max="255" required>
                                    </div>
                                    
                                    <div class="col-span-6 lg:col-span-2">
                                        <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                                        <input type="text" name="sku" id="sku" max="255" required autocomplete="sku" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-6 lg:col-span-2">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                                        <input type="number" name="price" id="price" step="0.01" required min="0.01" max="99999999.99" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-6 lg:col-span-2">
                                        <label for="stock" class="block text-sm font-medium text-gray-700">Existencias</label>
                                        <input type="number" name="stock" id="stock" required  max="999999999" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Imagen del producto
                                        </label>
                                        <div class="mt-1 flex items-center">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                                <label class="custom-file-label" class="block text-sm font-medium text-gray-700" for="inputGroupFile04">Agregar Imagen de Producto</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="category" class="block text-md font-semibold text-gray-700">Categoria</label>
                                    </div>
                                    @if (count($categories) >= 1)
                                    <div class="col-span-6 lg:col-span-3">
                                        <label for="category" class="block text-sm font-medium text-gray-700">Seleccionar una categoría existente</label>
                                        <select name="category" id="category" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->description }}">{{ $category->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2 lg:col-span-2 sm:col-span-6">
                                        <label for="add_category" class="block text-sm font-medium text-gray-700">Agregar una categoría nueva</label>
                                        <input type="text" name="add_category" disabled id="add_category" autocomplete="add_category" class="flex-col mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="">
                                        <input id="new_category" name="new_category" onclick="changeCategoryOpt()" value="new" type="checkbox">
                                    </div>
                                    @else
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="add_category" class="block text-sm font-medium text-gray-700">Agregar una categoría nueva</label>
                                            <input type="text" name="add_category" id="add_category" autocomplete="add_category" class="flex-col mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

