@extends('layouts.main')

@section('content')
    <div class="text-center my-10 border-b-2 border-black w-1/6 m-auto ">
        <h1 class="text-6xl inline">
            PREVIEW
        </h1>
    </div>
    @if (count($items->itemDetails) > 1)

        <div class=" w-1/6 mx-auto my-10">
            <div>
                <img src="{{ asset($itemDetail->image_path) }}" alt="" class="w-20 ml-20 inline">
                <img src="{{ asset($itemDetail->image_path) }}" alt="" class="w-20 -ml-1 inline">
            </div>
            <div>
                <img src="{{ asset($itemDetail->image_path) }}" alt="" class="w-20 inline">
                <img src="{{ asset($itemDetail->image_path) }}" alt="" class="w-20 -ml-1 inline">
            </div>
        </div>
        <div class="flex justify-center my-24 space-x-6">
            @foreach ($items->itemDetails as $item)
                @if ($item->id !== $itemDetail->id)
                    <a href="{{ route('details.show', ['detail' => $item->id]) }}">
                        <img src="{{ asset($item->image_path) }}" alt="" class="w-20 -ml-1 inline">
                    </a>
                @endif
            @endforeach
        </div>
    @else
        <div class=" w-1/6 mx-auto my-10">
            <img src="{{ asset($itemDetail->image_path) }}" alt="" class="">
        </div>
    @endif
    <div class=" bg-gray-200 w-1/2  mx-auto py-8 rounded-lg shadow-lg border-gray-400 border">
        <div class="grid grid-cols-3">
            <label class="text-3xl font-semibold justify-self-end">
                Item Name :
            </label>
            <span class="text-2xl font-semibold justify-self-center ">
                {{ $items->name }}
            </span>
        </div>
        <div class="grid grid-cols-3">
            <label class="text-3xl font-semibold justify-self-end">
                Item Type :
            </label>
            <span class="text-2xl font-semibold justify-self-center">
                {{ $items->type }}
            </span>
        </div>
        <div class="grid grid-cols-3">
            <label class="text-3xl font-semibold justify-self-end">
                Price :
            </label>
            <span class="text-2xl font-semibold justify-self-center">
                {{ $items->point }}
            </span>
        </div>
        @if ($items->id > 2)

            <div class="grid grid-cols-2 mt-6 ">
                <form action="{{ route('items.destroy', $items->id) }}" method="POST" class="ml-10">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('คุณต้องการที่จะลบไอเท็มชิ้นนี้หรือไม่')"
                        class="inline  bg-red-500 font-semibold text-2xl border-2 px-6 py-2 rounded-full hover:bg-red-300 hover:shadow-xl  ">Delete</button>
                </form>
                <a href="{{ route('items.edit', ['item' => $items]) }}" class="justify-self-end mr-10 -mb-4">
                    <button type="submit"
                        class="inline  bg-green-400 font-semibold text-2xl border-2 px-6 py-2 rounded-full hover:bg-green-200 hover:shadow-xl  ">Edit</button>
                </a>
            </div>
        @endif
    </div>
@endsection
