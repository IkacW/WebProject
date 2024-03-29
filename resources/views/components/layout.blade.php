<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/logo.jpg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>CarPart | Find Car Parts</title>
    </head>
    <body class="mb-48 bg-gray-900">
        <nav class="bg-gray-600 flex justify-between items-center ">
            <a href="/">
                <img class="w-24" src="{{asset('images/logo.jpg')}}" alt="" class="logo"/>
            </a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                    <li>
                        <span class="font-bold uppercase">
                            Welcome {{auth()->user()->name}}
                        </span>
                    </li>
                    @if(auth()->user()->permission != 0)
                        <li>
                            <a href="/listings/manage" class="hover:text-laravel">
                                <i class="fa-solid fa-gear"></i>Manage Listings
                                </a>
                        </li>
                    @endif 
                    @auth
                        <li>
                            <a href="/cart" class="hover:text-laravel">
                                <i class="fa-solid fa-shopping-cart"></i>Cart
                                </a>
                        </li>
                    @endauth 
                    <li>
                        <form method="POST" class="inline" action="/logout">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-door-closed "></i>Logout
                            </button>
                        </form>
                    </li>
                @else 
                    <li>
                        <a href="/register" class="hover:text-laravel">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    </li>
                    <li>
                        <a href="/login" class="hover:text-laravel">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>Login
                            </a>
                    </li>
                @endauth
            </ul>
        </nav>


        <main>
            {{$slot}}
        </main>

        <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-gray-900 text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>

        @auth
            @if(auth()->user()->permission != 0)
                <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post a part</a>
            @endif
        @endauth
        </footer>

        <x-flash-message />
    </body>
    
</html>