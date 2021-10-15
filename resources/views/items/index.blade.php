@extends('layouts.main')

@section('content')
    <div class="text-right m-4">
        <a href=" {{ route('items.createBackground') }} "
            class="bg-green-400 rounded-sm py-2 px-4 hover:bg-green-200 hover:shadow-lg">+ New
            background</a>
        <a href=" {{ route('items.create') }} "
            class="bg-green-400 rounded-sm py-2 px-4 hover:bg-green-200 hover:shadow-lg">+ New
            block</a>
    </div>

    <div class="grid grid-cols-3 gap-3 w-9/12 m-auto mt-14 bg-gradient-to-b from-indigo-300 to-gray-200 p-10">
        @isset($items)
            @foreach ($items as $item)
                <a href=" {{ route('items.slug', ['slug' => $item->name]) }} ">
                    <div class="bg-gray-200 text-center py-2 flex flex-col">
                        <div class="flex  flex-wrap justify-center">
                            @if (count($item->itemDetails) > 0)
                                <img src="{{ asset($item->itemDetails[0]->image_path) }}" class="max-h-10 max-w-xs" alt="" />
                            @endif
                        </div>
                        {{ $item->name }}
                    </div>
                </a>
            @endforeach
        @endisset
    </div>

@endsection
