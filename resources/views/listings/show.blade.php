<x-layout>

@include('partials._search')
    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="mx-4">
        <x-card class="!p-10">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                @if($listing->quantity == 0)
                    <div class="mb-10 mt-6"> 
                        <h1 style="font-size: 10vh" class="text-laravel text-lg">OUT OF STOCK</h1>
                    </div>
                @endif
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{$listing->image ? asset('storage/' . $listing->image) : asset('images/no-image.png')}}"
                    alt=""
                />

                <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
                <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
                
                <x-listing-tags :tagsCsv="$listing->tags" />

                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Part Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{$listing->description}}
                        </p>

                        <a
                            href="/listings/addToCart/{{$listing->id}}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-shopping-cart"></i>
                            Add to cart</a
                        >

                    </div>
                </div>
            </div>
        </x-card>
    </div>

</x-layout>