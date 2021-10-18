@extends('layouts.main')

@section('content')
    <div class="text-6xl font-semibold font-serif my-4 text-center">
        Change Current Point Rate
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
                <input type="text" autocomplete="off" name="rate" class="py-2 px-3 text-2xl rounded-lg">
            </div>
            @error('rate')
                <div class="ml-32 -mt-4">
                    <span class="text-red-600">{{ $message }}</span>
                </div>
            @enderror
            <div class="-mt-4 flex w-full justify-end">
                <button
                    class="py-2 px-6 rounded-xl text-3xl font-mono bg-blue-700 hover:bg-blue-800 shadow-md hover:shadow-lg text-gray-200"
                    type="submit">Submit Change</button>
            </div>
        </form>
    </div>
    <div class="flex space-x-2">
        <div class="p-5 mt-10 w-3/6 m-auto grid grid-cols-1 ">
            <h1 class="text-center text-3xl mb-4 border-b-2 border-indigo-400 mx-8 pb-3 font-sans font-semibold"> Point
                Rate
                History</h1>
            <table class="text-lg text-center text-gray-900 bg-gray-300 uppercase border border-gray-600 shadow-lg">
                <th class="px-3 py-3">index</th>
                <th class="px-3 py-3">point rate</th>
                <th class="px-10 py-3">set at</th>
                @foreach ($rate as $item)
                    <tr class="hover:bg-gray-200">
                        <td class="px-4 py-3 border border-gray-600">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="px-4 py-3 border border-gray-600">
                            {{ $item->rate }}
                        </td>
                        <td class="px-4 py-3 border border-gray-600">
                            {{ $item->created_at->format('d-M-y H:i:s a') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="p-5 mt-10 w-4/6 m-auto grid grid-cols-1">
            <h1 class="text-center text-3xl mb-4 border-b-2 border-indigo-400 mx-8 pb-3 font-sans font-semibold">
                Received
                Point History</h1>
            <table class="text-lg text-center text-gray-900 bg-gray-300 uppercase border border-gray-600 shadow-lg">
                <th class="px-3 py-3">index</th>
                <th class="px-3 py-3">Player Name</th>
                <th class="px-10 py-3">Point Amount <br /> (received)</th>
                <th class="px-10 py-3">get at</th>
                @foreach ($pointLog as $i)
                    <tr class="hover:bg-gray-200 ">
                        <td class="px-4 py-3  border border-gray-600">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="px-4 py-3 border border-gray-600">
                            {{ $i->user->name }}
                        </td>
                        <td class="px-4 py-3 border-gray-600 border">
                            {{ $i->point }}
                        </td>
                        <td class="px-4 py-3 border border-gray-600">
                            {{ $item->created_at->format('d-M-y H:i:s a') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
