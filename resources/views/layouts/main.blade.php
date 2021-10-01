<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('css/app.css') }}"></script>
</head>

<body class="bg-gray-100 space-y-5">
    <!-- nav -->
    <div class="py-4 px-10 bg-gray-800 space-x-2 flex justify-between items-center">
        <div>
            <a href="/" class="py-2 px-5 text-white rounded-full hover:bg-gray-700 text-xl
             ">Home</a>
            <a href="/textures" class="py-2 px-5 text-white rounded-full hover:bg-gray-700 text-xl">Texture
                Management</a>
        </div>
    </div>
    <div class="container mx-auto min-h-screen">
        @yield('content')
    </div>
    <div class="bg-gray-800 h-20">FOOTER</div>
</body>

</html>
