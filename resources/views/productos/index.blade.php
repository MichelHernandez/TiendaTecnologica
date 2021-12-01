<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mx-auto">
                    <x-auth-session-status class="mb-4 text-green-700" :status="session('status')" />
                    <x-auth-session-status class="mb-4 text-red-700" :status="session('error')" /> 
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <a href="{{ route('productos-create') }}" class="text-center border-b rounded-lg text-blue-50 bg-blue-800 mx-auto p-2 shadow hover:text-blue-900 hover:bg-white">Agregar un nuevo producto</a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre / SKU
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripción / Categoría
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Existencias
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($productos) >= 1)
                                        @foreach ($productos as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="/images/{{ $item->image }}" alt="{{ $item->imagen }}">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                        {{ $item->sku }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->description }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->category->description }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full  bg-green-100 text-green-800">
                                                    {{ $item->stock }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $item->price }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                   
                                                    <a href="{{ route('productos-show', ['id' => $item->id]) }}" class="text-indigo-600 hover:text-cyan-900 px-1">Detalles</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                No hay productos aún
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
