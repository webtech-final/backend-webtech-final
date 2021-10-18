@extends('layouts.main')
@section('content')
    <div class="mt-10 bg-gray-900 mx-64 p-24 rounded-xl">
        <div class="text-6xl font-serif text-center text-white">
            Add New Background
        </div>
        <div class="w-full mx-auto py-6 px-8 mt-10">
            <form action="{{ route('items.storeBackground') }} " method="post" enctype="multipart/form-data"
                class=" ">
                @csrf
                <div class="space-y-2">
                    <label for="name" id="lbName" class="text-2xl font-mono text-white">Name</label>
                    <input class="w-full text-xl block rounded-lg " type="text" name="name" placeholder="name"
                        autocomplete="off" placeholder="name">
                </div>
                @error('name')
                    <div>
                        <span class="text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <div class="space-y-2 mt-3 w-full">
                    <label for="Point" class="text-2xl font-mono text-white">Price</label>
                    <input type="text" class="w-full text-xl block rounded-lg " name="price" autocomplete="off"
                        placeholder="point">
                </div>
                @error('price')
                    <div>
                        <span class="text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <div class="space-y-2 mt-3">
                    <img id="backgroundImage" src="" alt="" class="max-h-36 max-w-4xl mt-3">
                    <label for="image" class="text-2xl font-mono text-white">Background Image</label>
                    <input type="file" name="backgroundImage" class="w-full text-xl bg-white" onchange="showImg(this)">
                </div>
                @error('backgroundImage')
                    <div>
                        <span class="text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <div class="mt-10 flex w-full justify-end">
                    <button type="submit"
                        class="py-2 px-6 rounded-xl text-3xl font-mono bg-blue-700 hover:bg-blue-800 shadow-md hover:shadow-lg text-gray-200">Add</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showImg(event) {
            var img = document.getElementById(event.name);
            if (event.files[0]) {
                img.src = URL.createObjectURL(event.files[0]);
            } else {
                img.src = ""
            }
        }
    </script>
@endsection
