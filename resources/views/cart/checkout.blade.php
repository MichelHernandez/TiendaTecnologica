<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />
                    <x-auth-session-status class="mb-4 text-yellow-600" :status="session('error')" />
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Esit</span>
                                    </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if (count(Cart::getContent()) >= 1)
                                    @foreach (Cart::getContent() as $item )
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                            
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="/images/{{ $item->attributes[0] }}" alt="{{ $item->image }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">

                                                <a href="{{ route('productos-show', ['id' => $item->id]) }}">{{ $item->name }}</a>

                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->price }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="hidden text-right md:table-cell">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                              @csrf
                                              <input type="hidden" value="{{ $item->id }}" name="id">
                                              <button class="px-4 py-2 text-white bg-red-600">x</button>
                                          </form>

                                          </td>
                                    </tr>
                                    @endforeach
                                @else 
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Aún no has agregado productos al carrito</td>
                                </tr>
                                @endif
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        <div class="grid grid-cols-2 m-3 gap-2 p-3 bg-white border-b border-gray-200 mx-auto">
                            @if (count(Cart::getContent()) >= 1)
                            <div class="col-span-2 justify-self-end">
                                Total: ${{ Cart::getTotal() }}
                            </div>
                            <div>
                                <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button class="justify-self-end text-center border-b my-auto rounded-lg text-red-50 bg-red-800 mx-auto p-2 shadow hover:text-red-900 hover:bg-white">Quitar todos los productos</button>
                                </form>
                            </div>
                            <div>
                                <form action="{{ route('pago', ['monto' => Cart::getTotal()]) }}" method="GET">
                                @csrf
                                <button class="justify-self-end text-center border-b my-auto rounded-lg text-blue-50 bg-blue-800 mx-auto p-2 shadow hover:text-blue-900 hover:bg-white">Pagar con Paypal</button>
                                </form>
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
