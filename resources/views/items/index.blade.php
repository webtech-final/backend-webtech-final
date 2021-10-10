@extends('layouts.main')

@section('content')
    <div class="text-right m-4">
        <a href=" {{ route('items.create') }} " class="bg-green-400 rounded-sm py-2 px-4 hover:bg-green-200">+ New
            item</a>
    </div>

    <div class="grid grid-cols-3 gap-3 w-9/12 m-auto mt-14 bg-gradient-to-b from-indigo-300 to-gray-200 p-10">
        @foreach ($items as $item)
            <div class="bg-gray-200 text-center py-2 flex flex-col">
                {{ $item->name }}
                <div class="flex  flex-wrap justify-center">
                    @foreach ($details as $detail)
                        @if ($detail->item_id === $item->id)
                            <img src="{{ asset(Str::replace('public/', 'storage/', $detail->image_path)) }}"
                                class="max-h-10 max-w-xs" alt="" />
                        @endif
                    @endforeach
                </div>
                <a href=" {{ route('items.edit', ['item' => $item->id]) }} "> Edit</a>
            </div>
        @endforeach
    </div>

@endsection
