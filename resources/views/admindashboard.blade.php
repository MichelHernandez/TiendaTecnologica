<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="welcome-message" class="p-6 bg-white border-b border-gray-200">
                    ¡Bienvenido! aquí puedes  administrar tus productos
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mx-auto">
                    <a href="{{ route('productos-index') }}" class="text-center border-b rounded-lg text-blue-50 bg-blue-800 mx-auto p-2 shadow hover:text-blue-900 hover:bg-white">Administrar productos</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
