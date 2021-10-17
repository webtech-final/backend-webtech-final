<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tetris.VS ADMIN</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/logo.png">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('css/app.css') }}"></script>
</head>

<body class="bg-gray-100 space-y-5">
    <!-- nav -->
    <div class="py-4 px-10 bg-gray-800 space-x-2 flex justify-between items-center">
        @if (Auth::check())
            <div>
                <a href="/items" class="py-2 px-5 text-white rounded-full hover:bg-gray-700 text-xl">Item
                    Management</a>
                <a href="/rate" class="py-2 px-5 text-white rounded-full hover:bg-gray-700 text-xl">Point Rate</a>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="post" class="inline-block">
                    @csrf
                    <button class="justify-self-end py-2 px-5 text-white rounded-full hover:bg-gray-700 text-xl">Logout
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}"
                class="justify-self-end py-2 px-5 text-white rounded-full hover:bg-gray-700 text-xl">Login</a>
        @endif
    </div>
    <div class="container mx-auto min-h-screen">
        @yield('content')
        @yield('javascript')
    </div>
    <div class="bg-gray-800 h-10"></div>
</body>

</html>
