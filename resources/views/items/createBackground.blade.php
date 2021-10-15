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
                    <input class="w-full text-xl block rounded-lg " type="text" name="name" placeholder="name" placeholder="name">
                </div>
                @error('name')
                    <div>
                        <span class="text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <div class="space-y-2 mt-3 w-full">
                    <label for="Point" class="text-2xl font-mono text-white">Price</label>
                    <input type="text" class="w-full text-xl block rounded-lg " name="point" placeholder="point">
                </div>
                @error('price')
                    <div>
                        <span class="text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <div class="space-y-2 mt-3">
                    <label for="image" class="text-2xl font-mono text-white">Background Image</label>
                    <input type="file" name="backgroundImage" class="w-full text-xl bg-white w-full">
                </div>
                @error('backgroundImage')
                    <div>
                        <span class="text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <div class="mt-10">
                    <button type="submit"
                        class="w-full bg-green-400 font-mono text-2xl px-6 py-2 rounded-full hover:bg-green-500 hover:shadow-xl">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
