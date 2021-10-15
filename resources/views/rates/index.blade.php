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
                class="bg-green-400 text-xl px-4 py-2 font-semibold rounded  hover:bg-green-200 mx-2">Change Rate
            </a>
        </div>
    </div>

    <div class="flex space-x-2">
        <div class="p-5 mt-10 w-3/6 m-auto grid grid-cols-1 ">
            <h1 class="text-center text-3xl mb-4 border-b-2 border-indigo-400 mx-8 pb-3 font-sans font-semibold"> Point Rate
                History</h1>
            <table class="text-lg text-center text-gray-900 bg-gray-300 uppercase border-b border-gray-600">
                <th class="px-3 py-3">index</th>
                <th class="px-3 py-3">point rate</th>
                <th class="px-10 py-3">set at</th>
                @foreach ($rate as $item)
                    <tr class="hover:bg-gray-200">
                        <td class="px-4 py-3 border">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="px-4 py-3 border">
                            {{ $item->rate }}
                        </td>
                        <td class="px-4 py-3 border">
                            {{ $item->created_at->format('d-M-y H:i:s a') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="p-5 mt-10 w-4/6 m-auto grid grid-cols-1">
            <h1 class="text-center text-3xl mb-4 border-b-2 border-indigo-400 mx-8 pb-3 font-sans font-semibold"> Received
                Point History</h1>
            <table class="text-lg text-center text-gray-900 bg-gray-300 uppercase border-b border-gray-600">
                <th class="px-3 py-3">index</th>
                <th class="px-3 py-3">Player Name</th>
                <th class="px-10 py-3">Point Amount <br /> (received)</th>
                <th class="px-10 py-3">get at</th>
                @foreach ($pointLog as $i)
                    <tr class="hover:bg-gray-200">
                        <td class="px-4 py-3 border">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="px-4 py-3 border">
                            {{ $i->user->name }}
                        </td>
                        <td class="px-4 py-3 border">
                            {{ $i->point }}
                        </td>
                        <td class="px-4 py-3 border">
                            {{ $item->created_at->format('d-M-y H:i:s a') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
