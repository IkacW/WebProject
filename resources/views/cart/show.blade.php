@php
    use App\Models\Listing;

    $product_ids = explode(',', $cart->product_ids);
    $quantities = explode(',', $cart->quantities);
    $counter = 0;
    $total = 0;

    $listings = array();
    for($i = 1; $i < sizeof($product_ids); $i++) {
        $listings[$i - 1] = Listing::find($product_ids[$i]);
    }
@endphp
<x-layout>
    <x-card class="!p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Cart
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                
                @unless(count($listings) == 0)
                @foreach($listings as $listing)
                @php
                    $counter++;
                    $total = $total + $quantities[$counter] * $listing->price;
                @endphp
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <img class="w-40" src="{{$listing->image ? asset('storage/' . $listing->image) : asset('images/no-image.png')}}" alt="Part Image">
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="/listings/{{$listing->id}}">
                            <span class="text-laravel">Name:</span> {{$listing->name}}
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center"><span class="text-laravel">Quantity:</span> {{$quantities[$counter]}}</p>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center"><span class="text-laravel">Price:</span> {{$quantities[$counter] * $listing->price}}</p>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a
                        href="/listings/addToCart/{{$listing->id}}"
                        class="block text-center bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-shopping-cart"></i>
                        Add one to cart</a>

                        <a
                            href="/listings/removeFromCart/{{$listing->id}}"
                            class="block text-center bg-blue-400 text-white mt-6 py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-shopping-cart"></i>
                            Remove one from cart</a
                        >
                    </td>
                </tr>

                @endforeach
                @else 

                <tr>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">Your cart is empty.</p>
                    </td>
                </tr>

                @endunless
            </tbody>
        </table>

        <h1 class="text-left text-lg mt-7">
            <span class="text-laravel">Total:</span> {{$total}}
        </h1>

        <div class="container d-flex justify-content-center">
            <form method="POST" action="/order">
                @csrf
                <div class="mb-4 ">
                    <label
                    for="adress"
                    class="block text-lg text-left mb-2"
                    >Adress</label>
                
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-1/2"
                        name="adress"
                        placeholder="Example: 72 Pulaski Drive, Olive Branch, MS 38654"/>

                    @error('adress')
                        <p class="text-red-500 text-xs mt-1">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black text-center">
                        Place an order
                    </button>
                </div>
            </form>
        </div>
    </x-card>
</x-layout>