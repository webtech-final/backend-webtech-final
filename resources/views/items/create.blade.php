@extends('layouts.main')
@section('content')
    <div class="text-6xl font-serif">
        Add New Block
    </div>
    <form action="{{ route('items.store') }} " method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 place-items-center w-1/3 mx-auto ">
        {{-- <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data"> --}}
        @csrf
        <div>
            <label for="name" id="lbName" class="text-2xl">Name</label>
            <input class="w-full" type="text" name="name" placeholder="name">
        </div>
        @error('name')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div class="place-items-start">
            <label for="Point" class="text-2xl">Price</label>
            <input type="text" class="w-full" name="point" placeholder="point">
        </div>
        @error('point')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div class="">
            <label for="image" class="text-2xl">Texture for Block S</label>
            <input type="file" name="blockS" class="w-full" value="{{ old('blockS') }}">
        </div>
        @error('blockS')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div class="">
            <label for="image" class="text-2xl">Texture for Block Z</label>
            <input type="file" name="blockZ" class="w-full" value="{{ old('blockZ') }}">
        </div>
        @error('blockZ')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="image" class="text-2xl">Texture for Block L</label>
            <input type="file" name="blockL" class="w-full" value="{{ old('blockL') }}">
        </div>
        @error('blockL')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="image" class="text-2xl">Texture for Block J</label>
            <input type="file" name="blockJ" class="w-full" value="{{ old('blockJ') }}">
        </div>
        @error('blockJ')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="image" class="text-2xl">Texture for Block T</label>
            <input type="file" name="blockT" class="w-full" value="{{ old('blockT') }}">
        </div>
        @error('blockT')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="image" class="text-2xl">Texture for Block O</label>
            <input type="file" name="blockO" class="w-full" value="{{ old('blockO') }}">
        </div>
        @error('blockO')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="image">Texture for Block I</label>
            <input type="file" name="blockI" class="w-full" value="{{ old('blockI') }}">
        </div>
        @error('blockI')
            <div>
                <span class="text-red-600">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <button type="submit">Add</button>
        </div>
    </form>

@endsection
