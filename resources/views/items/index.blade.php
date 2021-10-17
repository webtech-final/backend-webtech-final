@extends('layouts.main')

@section('content')
    @if (session()->exists('message'))
        <div class="bg-green-200 border border-green-500 rounded-lg py-4 px-6 text-green-900">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 ">
        <div class="mt-3 ">
            <h1 class="text-6xl font-serif">Background List</h1>
        </div>
        <div class="mt-6 text-right w-9/12 mx-auto space-x-3">
            <a href=" {{ route('items.createBackground') }} "
                class="bg-blue-600 rounded-md ring ring-indigo-300 text-gray-100 py-2 px-4 hover:bg-blue-200 hover:shadow-lg hover:text-gray-900 ">+
                New
                background</a>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-8 w-9/12 rounded-lg mx-auto my-10 bg-gradient-to-b from-indigo-500 to-gray-200 p-10">
        @isset($bg)
            @foreach ($bg as $item)
                <a href=" {{ route('items.slug', ['slug' => $item->name, 'type' => $item->type]) }} ">
                    <div class="bg-gray-200 text-center py-2 flex flex-col rounded-md">
                        <div class="flex  flex-wrap justify-center">
                            @if (count($item->itemDetails) > 0)
                                <img src="{{ asset($item->itemDetails[0]->image_path) }}" class="max-h-24 max-w-2xl" alt="" />
                            @endif
                        </div>
                        <p>
                            {{ $item->name }}
                        </p>
                        <div class="flex justify-between px-6 my-3">
                            <button href="{{ route('items.slug', ['slug' => $item->name, 'type' => $item->type]) }}"
                                class="bg-blue-600 rounded-md ring ring-indigo-300 text-gray-100 hover:bg-blue-200 hover:shadow-lg hover:text-gray-900 w-1/3">Detail</button>
                            @if ($item->id > 2)

                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('คุณต้องการที่จะลบไอเท็มชิ้นนี้หรือไม่')"
                                        class="bg-red-600 rounded-md ring ring-red-300 text-gray-100 hover:bg-red-200 hover:shadow-lg hover:text-gray-900 px-4 ">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        @endisset
    </div>
    <div class="border-b-2 border-gray-600 md:w-1/2 m-auto "></div>
    <div class="mt-3">
        <h1 class="text-6xl font-serif">Block List</h1>
    </div>
    <div class="text-right w-9/12 m-auto space-x-3">
        <a href=" {{ route('items.create') }} "
            class="bg-blue-600 rounded-md ring ring-indigo-300 text-gray-100 py-2 px-4 hover:bg-blue-200 hover:shadow-lg hover:text-gray-900">+
            New
            block</a>
    </div>
    <div class="grid grid-cols-4 gap-8 w-9/12 mx-auto mt-10 bg-gradient-to-b from-indigo-500 to-gray-200 p-10">
        @isset($items)
            @foreach ($items as $item)
                <a href=" {{ route('items.slug', ['type' => $item->type, 'slug' => $item->name]) }} ">
                    <div class="bg-gray-200 text-center py-2 flex flex-col rounded-md">
                        <div class="flex  flex-wrap justify-center">
                            @if (count($item->itemDetails) > 0)
                                <img src="{{ asset($item->itemDetails[0]->image_path) }}" class="max-h-10 max-w-xs" alt="" />
                            @endif
                        </div>
                        {{ $item->name }}
                        <div class="flex justify-between px-6 my-3">
                            <button href="{{ route('items.edit', ['item' => $item->id, 'type' => $item->type]) }}"
                                class="bg-blue-600 rounded-md ring ring-indigo-300 text-gray-100 hover:bg-blue-200 hover:shadow-lg hover:text-gray-900 w-1/3">EDIT</button>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('คุณต้องการที่จะลบไอเท็มชิ้นนี้หรือไม่')"
                                    class="bg-red-600 rounded-md ring ring-red-300 text-gray-100 hover:bg-red-200 hover:shadow-lg hover:text-gray-900 px-4 ">Delete</button>
                            </form>
                        </div>
                    </div>
                </a>
            @endforeach
        @endisset
    </div>

@endsection
