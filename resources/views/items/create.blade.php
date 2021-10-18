@extends('layouts.main')
@section('content')

    <div class="mt-10 bg-gray-900 mx-64 p-24 rounded-xl text-white">
        <div class="text-6xl font-serif text-center text-white">
            Add New Block
        </div>

        <form action="{{ route('items.store') }} " method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1  w-full mx-auto">
            @csrf
            <div class="w-full mt-5">
                <label for="name" id="lbName" class="text-2xl font-mono ">Name</label>
                <input autocomplete="off" class="w-full text-xl border-2 shadow-md hover:shadow-lg text-black" type="text"
                    name="name" placeholder="name">
            </div>
            @error('name')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="place-items-start w-full mt-3">
                <label for="Point" class="text-2xl font-mono ">Price</label>
                <input autocomplete="off" type="text" class="w-full text-xl border-2 shadow-md hover:shadow-lg text-black"
                    name="point" placeholder="point">
            </div>
            @error('point')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="text-left w-full">
                <h1 class="text-4xl font-mono text-white mt-4">Image Section</h1>
            </div>
            <div class="mt-3 w-full">
                <img id="blockS" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block S</label>
                <input type="file" name="blockS" class="w-full text-xl  border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockS') }}">
            </div>
            @error('blockS')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <img id="blockZ" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block Z</label>
                <input type="file" name="blockZ" class="w-full text-xl border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockZ') }}">
            </div>
            @error('blockZ')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <img id="blockL" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block L</label>
                <input type="file" name="blockL" class="w-full text-xl  border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockL') }}">
            </div>
            @error('blockL')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <img id="blockJ" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block J</label>
                <input type="file" name="blockJ" class="w-full text-xl  border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockJ') }}">
            </div>
            @error('blockJ')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <img id="blockT" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block T</label>
                <input type="file" name="blockT" class="w-full text-xl  border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockT') }}">
            </div>
            @error('blockT')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <img id="blockO" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block O</label>
                <input type="file" name="blockO" class="w-full text-xl  border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockO') }}">
            </div>
            @error('blockO')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <img id="blockI" src="" alt="" class="max-h-36 max-w-4xl">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block I</label>
                <input type="file" name="blockI" class="w-full text-xl  border-2 shadow-md hover:shadow-lg"
                    onchange="showImg(this)" value="{{ old('blockI') }}">
            </div>
            @error('blockI')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-10 flex w-full justify-end">
                <button
                    class="bg-blue-600 font-semibold text-2xl border-2 px-6 py-2 rounded-full  text-gray-100 hover:bg-blue-200 hover:shadow-lg hover:text-gray-900"
                    type="submit">ADD</button>
            </div>
        </form>

    </div>
    <script>
        var APP_URL = '{{ env('MIX_LARAVEL_END_POINT') }}'

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
