<x-layout>
    <x-card class="!p-10 !max-w-lg !mx-auto !mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                LOGIN
            </h2>
            <p class="mb-4">Log into your account to post gigs</p>
        </header>

        <form method="POST" action="/users/authenticate">
            @csrf

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
                <label
                    for="password"
                    class="inline-block text-lg mb-2"
                >
                    Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password"
                    value="{{old('password')}}"
                />
            </div>

            <div class="mb-4">
                <a href="#" class="text-sm red-500 hover-a">
                    Forgot password? Reset it now!
                </a>
            </div>

            <div class="mb-6">
                <button
                    type="submit"
                    class="text-white rounded py-2 px-4 bg-gray-900 hover:bg-gray-800"
                >
                    Sign in
                </button>
            </div>

            <div class="mt-8">
                <p>
                    You dont have account? Create a new one!
                    <a href="/register" class="text-laravel hover-a"
                        >Register</a
                    >
                </p>
            </div>
        </form>
    </x-card>
</x-layout>