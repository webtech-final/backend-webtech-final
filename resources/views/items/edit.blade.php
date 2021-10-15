@extends('layouts.main')

@section('content')
    <div class="text-6xl font-serif">
        Add New Texture
    </div>
    {{-- <form action="{{ route('items.update', ['item' => $items->id]) }} "> --}}
    <form action="{{ route('items.update', ['item' => $items->id]) }} " method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="name" value="{{ old('name', $items->name) }} ">

        </div>
        @isset($items->itemDetails)
            @foreach ($items->itemDetails as $item)
                <div class="flex">
                    <label for="blockS">{{ $item->name }}</label>
                    <img src="{{ asset($item->image_path) }} " alt="">
                    <input type="file" name="{{ $item->name }}">
                    {{-- <input type="file" name="{{ $item->name }}" value="{{ $item->name }}" class="w-full"> --}}
                </div>
            @endforeach
        @endisset
        <div>
            <button type="submit">Add</button>
        </div>
    </form>
@endsection
