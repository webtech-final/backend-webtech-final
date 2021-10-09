@extends('layouts.main')

@section('content')
    <div class="text-right m-4">
        <a href=" {{ route('items.create') }} " class="bg-green-400 rounded-sm py-2 px-4 hover:bg-green-200">+ New
            item</a>
    </div>

    <div class="grid grid-cols-3 gap-3 ">
        @foreach ($items as $item)
            <div class="bg-gray-200 text-center py-2">
                {{ $item->name }}
                <img src=" {{ $item->uri }} " alt="" />
                <a href=" {{ route('items.edit', ['item' => $item->id]) }} "> Edit</a>
            </div>
        @endforeach

    </div>
@endsection
