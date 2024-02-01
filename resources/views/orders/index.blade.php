<x-layout>
    @include('partials._hero')
    
    <x-card class="!p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Order List
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($orders->isEmpty())
                    
                    @foreach($orders as $order)
                    
                    <tr class="border-gray-300 rounded-top bg-secondary">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg"> 
                            <img class="w-40" src="{{$order->image ? asset('storage/' . $order->image) : asset('images/no-image.png')}}" alt="Part Image">
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <a href="/listings/{{$order->listing_id}}">
                                {{$order->name}}
                            </a>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <p>{{$order->quantity}}</p>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <p>{{$order->adress}}</p>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <p>{{$order->created_at}}</p>
                        </td>
                    </tr>

                    @endforeach
                @else 

                <tr>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No orders found.</p>
                    </td>
                </tr>

                @endunless
            </tbody>
        </table>
    </x-card>

</x-layout>