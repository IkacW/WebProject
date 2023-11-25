<x-layout>
    <x-card class="!p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Users
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                
                @unless(count($users) == 0)
                @foreach($users as $user)
                <tr class="border-gray-300">
                   <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <span class="text-laravel">Name:</span> {{$user->name}}
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-left"><span class="text-laravel">Email:</span> {{$user->email}}</p>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <span class="text-laravel">Permission:</span> {{$user->permission}}
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a
                        href="/users/{{$user->id}}/edit"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                    </td>
                </tr>

                @endforeach
                @else 

                <tr>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No users found.</p>
                    </td>
                </tr>

                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>