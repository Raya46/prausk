@extends('template.temp_navbar')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col p-3">
            <div class="card glass">
                <div class="card-body">
                    <div class="flex items-center justify-center text-2xl gap-3">
                        <span class="bg-base-100 p-4 rounded-lg">History Topup</span>
                        <a href="/history" class="bg-base-100 p-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="fill-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5" />
                            </svg>
                        </a>
                    </div>
                    @foreach ($wallets as $wallet)
                        @if ($wallet->credit != 0)
                            <div class="card bg-base-100 p-6 mt-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex flex-col">
                                        <span class="card-title font-bold">
                                            Rp. {{ number_format($wallet->credit) }}
                                        </span>
                                        <span class="text-sm text-gray-500">{{ $wallet->updated_at }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="badge badge-outline p-3">{{ $wallet->status }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

            </div>
        </div>
    </div>

    <div class="btm-nav bg-transparent">
        <a href="/download?type=topup" target="_blank">Download All</a>
    </div>
@endsection
