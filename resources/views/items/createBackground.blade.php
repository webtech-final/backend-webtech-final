@extends('layouts.main')
@section('content')

    <div class="text-6xl font-serif">
        Add New Background
    </div>
    <div class="w-1/2 mx-auto bg-gray-300 py-6 px-8 mt-8">
        <form action="{{ route('items.storeBackground') }} " method="post" enctype="multipart/form-data"
            class=" ">
            @csrf
            <div class="space-y-2">
                <label for="name" id="lbName" class="text-2xl">Name</label>
                <input class="w-3/4 block rounded-lg " type="text" name="name" placeholder="name" placeholder="name">
            </div>
            @error('name')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="space-y-2 mt-2">
                <label for="Point" class="text-2xl">Price</label>
                <input type="text" class="w-3/4 block rounded-lg " name="point" placeholder="point">
            </div>
            @error('price')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="space-y-2 mt-2">
                <label for="image" class="text-2xl">Background Image</label>
                <input type="file" name="backgroundImage" class="w-full">
            </div>
            @error('backgroundImage')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-4 text-right ">
                <button type="submit"
                    class="bg-green-400 font-semibold text-2xl border-2 px-6 py-2 rounded-full hover:bg-green-200 hover:shadow-xl">Add</button>
            </div>
        </form>
    </div>
@endsection
