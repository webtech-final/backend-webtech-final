@extends('layouts.main')
@section('content')

    <div class="mt-10 bg-gray-900 mx-64 p-24 rounded-xl">
        <div class="text-6xl font-serif text-center text-white">
            Add New Block
        </div>

        <form action="{{ route('items.store') }} " method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 place-items-center w-full mx-auto">
            @csrf
            <div class="w-full mt-5">
                <label for="name" id="lbName" class="text-2xl font-mono text-white">Name</label>
                <input autocomplete="off" class="w-full text-xl border-2 shadow-md hover:shadow-lg" type="text" name="name"
                    placeholder="name">
            </div>
            @error('name')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="place-items-start w-full mt-3">
                <label for="Point" class="text-2xl font-mono text-white">Price</label>
                <input autocomplete="off" type="text" class="w-full text-xl border-2 shadow-md hover:shadow-lg" name="point"
                    placeholder="point">
            </div>
            @error('point')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="text-left w-full">
                <h1 class="text-4xl font-serif text-white mt-4">Image </h1>
            </div>
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block S</label>
                <input type="file" name="blockS" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockS') }}">
            </div>
            @error('blockS')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block Z</label>
                <input type="file" name="blockZ" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockZ') }}">
            </div>
            @error('blockZ')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block L</label>
                <input type="file" name="blockL" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockL') }}">
            </div>
            @error('blockL')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block J</label>
                <input type="file" name="blockJ" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockJ') }}">
            </div>
            @error('blockJ')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block T</label>
                <input type="file" name="blockT" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockT') }}">
            </div>
            @error('blockT')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block O</label>
                <input type="file" name="blockO" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockO') }}">
            </div>
            @error('blockO')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-3 w-full">
                <label for="image" class="text-2xl font-mono text-white">Texture for Block I</label>
                <input type="file" name="blockI" class="w-full text-xl bg-white border-2 shadow-md hover:shadow-lg"
                    value="{{ old('blockI') }}">
            </div>
            @error('blockI')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="mt-10 flex w-full justify-end">
                <button
                    class="py-2 px-6 rounded-xl text-3xl font-mono bg-blue-700 hover:bg-blue-800 shadow-md hover:shadow-lg text-gray-200"
                    type="submit">ADD</button>
            </div>
        </form>

    </div>

@endsection
