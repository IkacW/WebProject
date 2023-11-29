<x-layout>
    <div class="mt-10 max-w-lg mx-auto">
        <x-card class="!p-10">
            <form method="POST" action="/password-change">
                @csrf
                @method('PUT')
                <input type="text" hidden name="token" value="{{$token}}">

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
                
                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">New passwrod</label>
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="password"
                        value="{{old('password')}}"
                    />
                    
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="" class="inline-block text-lg mb-2"
                        >Confirm password</label
                    >
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="password_confirmation"
                        value="{{old('password_confirmation')}}"
                    />
                    
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
    
                <div>
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