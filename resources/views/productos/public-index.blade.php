<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalogo') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            @if (count($productos)>=1)
                 @foreach ($productos as $item)
                 <a href="{{ route('productos-show', ['id' => $item->id]) }}" class="group">
                    <div class="w-full aspect-w-1 aspect-h-1 bg-white rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                        <img class="w-full h-full object-center object-cover group-hover:opacity-75" src="/images/{{ $item->image }}" alt="{{ $item->imagen }}">
                            <div>
                                <h3 class="mt-4 text-sm text-gray-700">{{ $item->name }}</h3>
                                <p class="mt-1 text-lg font-medium text-gray-900">${{ $item->price }}</p>
                            </div>
                    </div>
                 </a>
                @endforeach

            @else
            <div class="bg-gray-200 rounded overflow-hidden shadow-md">
                <div>
                    <span>No hay productos aún</span>
                    <span>Por favor espere a que se registren productos</span>
                </div>
            </div>

            @endif
            </div>
        </div>
    </div>
</x-app-layout>
