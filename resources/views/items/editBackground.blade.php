@extends('layouts.main')

@section('content')
    <div class="mt-10 bg-gray-900 mx-64 p-24 rounded-xl text-white">
        <div class="text-6xl font-serif text-center">
            Edit Block Texture
        </div>
        <form action="{{ route('items.updatebg', ['item' => $items->id]) }} " method="post" enctype="multipart/form-data"
            class="grid grid-cols-1 place-items-center w-full mx-auto">
            @csrf
            @method('PUT')
            <div class="w-full mt-5">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="name" autocomplete="off"
                    class="w-full text-xl border-2 shadow-md hover:shadow-lg text-black"
                    value="{{ old('name', $items->name) }} ">

            </div>
            @error('name')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="w-full mt-5">
                <label for="name">Price</label>
                <input type="text" name="price" placeholder="price"
                    class="w-full text-xl text-black border-2 shadow-md hover:shadow-lg" autocomplete="off"
                    value="{{ old('price', $items->point) }} ">

            </div>
            @error('price')
                <div>
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            @isset($items->itemDetails)
                @foreach ($items->itemDetails as $item)
                    <div class="grid-cols-1 grid space-y-4  mt-6 w-full">
                        <img id="{{ $item->name . 'img' }}" src="{{ asset($item->image_path) }} " alt=""
                            class="max-h-36 max-w-4xl">
                        <label class="text-xl" for="blockS">{{ Str::of($item->name)->upper }}</label>
                        <input type="file" name="{{ $item->name }}" onchange="showImg(this, {{ $item->name }})"
                            class="w-full text-xl border-2 shadow-md hover:shadow-lg">
                    </div>
                    @error($item->name)
                        <div>
                            <span class="text-red-600">{{ $message }}</span>
                        </div>
                    @enderror
                @endforeach
            @endisset
            <div class="mt-16 justify-self-end">
                <button type="submit"
                    class="bg-blue-600 font-semibold text-2xl border-2 px-6 py-2 rounded-full ring ring-indigo-300 text-gray-100 hover:bg-blue-200 hover:shadow-lg hover:text-gray-900  ">
                    Submit</button>
            </div>
        </form>
    </div>

    <script>
        var APP_URL = '{{ env('MIX_LARAVEL_END_POINT') }}'

        function showImg(event) {
            var img = document.getElementById(event.name + 'img');
            if (event.files[0]) {
                img.src = URL.createObjectURL(event.files[0]);
            } else {
                let path = {!! json_encode($items->toArray(), JSON_HEX_TAG) !!};
                let img_path;
                path.item_details.forEach(element => {
                    if (element.name === event.name) {
                        img_path = element.image_path
                    }
                });
                img.src = APP_URL + img_path
            }
        }
    </script>
@endsection
