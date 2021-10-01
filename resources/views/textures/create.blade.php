@extends('layouts.main')
@section('content')
    <div class="text-6xl font-serif">
        Add New Texture
    </div>
    <!-- <form action="{{ route('textures.store') }} "> -->
    <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="name">

        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="selectedImage" class="w-full">
        </div>
        @error('selectedImage')
            <div>
                <span>{{ $message }}</span>
            </div>
        @enderror
        <div>
            <button type="submit">Add</button>
        </div>
    </form>
@endsection
