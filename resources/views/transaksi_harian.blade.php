@extends('template.temp_navbar')

@section('content')
    <div class="container mx-auto">
        <div class="card glass p-4">
            @forelse ($transactions as $date => $transaction)
                <div class="card card-body bg-base-100 border border-white my-2">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-lg font-bold">
                            {{ $date }}
                        </span>
                        <a class="rounded-full btn bg-white" target="_blank" href="/transaksi-harian/{{ $date }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="fill-black" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                            </svg>
                        </a>
                    </div>

                    @foreach ($transaction as $ts)
                        <div class="flex flex-col border border-white rounded-lg p-4 gap-2">
                            <span class="text-lg font-bold">{{ $ts->product->name }}</span>

                            <div class="flex gap-2 items-center">
                                <span>Rp.{{ number_format($ts->price) }} {{ $ts->quantity }}x</span>
                                <span class="badge badge-outline">{{ $ts->status }}</span>
                            </div>
                            <span class="badge badge-outline">{{ $ts->user->name }}</span>

                            <span class="text-xs mt-2 text-gray-500">{{ $ts->created_at }}</span>
                        </div>
                    @endforeach
                </div>
            @empty
                <span class="text-center btn">Transaksi Kosong</span>
            @endforelse


        </div>

    </div>
    <div class="btm-nav bg-transparent">
        <a href="/download?type=ts" target="_blank">Download All</a>
    </div>
@endsection
