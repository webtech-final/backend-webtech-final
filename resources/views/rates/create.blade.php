@extends('layouts.main')

@section('content')
    <div class="text-6xl font-serif my-4 text-center">
        Add New Texture
    </div>
    <div class="w-2/5 m-auto">
        <form action=" {{ route('rate.store') }} " method="POST" class="grid grid-cols-1 gap-8 bg-gray-200 p-6">
            @method('POST')
            @csrf
            <div>
                <label for="rate" class="text-2xl font-semibold ">Current Rate : </label>
                <label for="currentRate" class="text-2xl font-medium">
                    {{ $last->rate }}
                </label>
            </div>
            <div>
                <label for="rate" class="text-2xl font-semibold ">New Rate : </label>
                <input type="text" autocomplete="off" name="rate" class="py-2 px-3 text-2xl ">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-green-500 px-4 py-2 rounded font-semibold text-xl  hover:bg-green-300">Submit
                    Change</button>
            </div>
        </form>
    </div>
@endsection
