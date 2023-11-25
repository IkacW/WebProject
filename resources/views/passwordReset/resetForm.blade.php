<x-layout>

    <div class="!mt-10 !max-w-lg !mx-auto">
        <x-card class="!p-10">
            <h2 class="text-2xl font-bold uppercase text-center">Reset Password</h1>
            <p class="text-center font-bold">The link will be sent to your email.</p>
            <form method="POST" action="/reset-password">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2"
                        >Email</label
                    >
                    <input
                        type="email"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="email"
                        value="{{old('email')}}"
                    />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="">
                    <button
                        type="submit"
                        class="text-white rounded py-2 px-4 bg-gray-900 hover:bg-gray-800"
                    >
                        Reset Password
                    </button>
                </div>
            </form>
        </x-card>
    </div>

</x-layout>