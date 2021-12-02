<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                    <img
                        class="object-cover w-full h-96"
                        src="/images/pc.png"
                        alt="image"
                    />
                    </div>
                    <div class="swiper-slide">
                    <img
                        class="object-cover w-full h-96"
                        src="/images/pc2.jpg"
                        alt="image"
                    />
                    </div>
                    <div class="swiper-slide">
                    <img
                        class="object-cover w-full h-96"
                        src="/images/pc3.jpg"
                        alt="image"
                    />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                </div>

                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
                    <script>
                    var swiper = new Swiper(".mySwiper", {
                        cssMode: true,
                        navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                        },
                        pagination: {
                        el: ".swiper-pagination",
                        },
                        mousewheel: true,
                        keyboard: true,
                    });
                    </script>
                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @if (count($productos) >= 1)
                        @foreach ($productos as $item)
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <img src="/images/{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                            <a href="#">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $item->name }}
                            </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $item->description }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ $item->price }}</p>
                        </div>
                    </div>
                        @endforeach
                    @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-guest-layout>