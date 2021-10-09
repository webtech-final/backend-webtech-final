@extends('layouts.main')

@section('content')

    <div>
        <h2 class="text-6xl text-center font-serif font-semibold m-4">Current Rate</h2>
    </div>
    <div class="text-center  grid grid-cols-1 gap-5 bg-gray-200 p-6 w-2/5 m-auto ">
        <div>
            <label for="rate" class="text-2xl font-semibold ">Current Rate : </label>
            <label for="currentRate" class="text-2xl font-medium">
                {{ $last->rate }}
            </label>
        </div>
        <div>
            <a href=" {{ route('rate.change', ['rate' => $last->id]) }} "
                class="bg-green-400 text-xl px-4 py-2 font-semibold rounded  hover:bg-green-200 mx-2">Test Rate
            </a>
        </div>
    </div>

    <div class="p-5 mt-10 w-2/6 m-auto justify-center flex">
        <table class="text-lg text-center text-gray-900 bg-gray-300 uppercase border-b border-gray-600">
            <th class="px-3 py-3">index</th>
            <th class="px-3 py-3">rate</th>
            <th class="px-10 py-3">created at</th>
            @foreach ($rate as $item)
                <tr class="hover:bg-gray-200">
                    <td class="px-4 py-3 border">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="px-4 py-3 border">
                        {{ $item->rate }}
                    </td>
                    <td class="px-4 py-3 border">
                        {{ $item->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
