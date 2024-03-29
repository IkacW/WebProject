<x-layout>
    <x-card class="!p-10 !max-w-lg !mx-auto !mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1"> Edit User </h2>
            <p class="mb-4">{{$user->email}}</p>
        </header>

        <form method="POST" action="/users/{{$user->id}}">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >Name</label>

                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{$user->name}}"/>

                @error('name')
                    <p class="text-red-500 text-xs mt-1">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">
                    Email
                </label>

                <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                value="{{$user->email}}"/>

                @error('email')
                    <p class="text-red-500 text-xs mt-1">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="quantity"
                    class="inline-block text-lg mb-2"
                >
                    Permission
                </label>
    
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="permission"
                    placeholder="0-2"
                    value="{{$user->permission}}"/>

                @error('permission')
                    <p class="text-red-500 text-xs mt-1">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Edit User
                </button>

                <a href="/users/menu" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>