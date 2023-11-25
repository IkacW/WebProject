<section
            class="relative h-72 bg-gray-500 flex flex-col justify-center align-center text-center space-y-4 mb-4"
        >
            <div
                class="bg-image absolute top-0 left-0 w-full h-full opacity-70 bg-no-repeat bg-center"
                style="background-image: url('images/hero_banner.jpg')"
            ></div>

            <div class="z-10">
                <h1 class="text-6xl font-bold uppercase text-white">
                    Car<span class="text-gray-900">Parts</span>
                </h1>
                <p class="text-2xl text-gray-200 font-bold my-4">
                    Find your part
                </p>
                <div>
                    @auth 
                        @if(auth()->user()->permission != 0)
                            <a
                            href="/listings/create"
                            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-gray-900 hover:border-gray-900">
                            List a Part</a>
                        @endif
                    @else 
                        <a
                            href="/register"
                            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-gray-900 hover:border-gray-900">
                            Sign Up to Buy a Part</a
                        >
                    @endauth
                </div>
            </div>
</section>