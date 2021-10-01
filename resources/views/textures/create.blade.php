@extends('layouts.main')
@section('content')
    <div class="text-6xl font-serif">
        Add New Texture
    </div>
    <form action="{{ route('textures.store') }} ">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="name">

        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" class="w-full">
        </div>
        <div>
            <button type="submit">Add</button>
        </div>
    </form>
@endsection
