@extends('template.temp_navbar')

@section('content')
    @php
        $totalBayar = 0;
    @endphp
    @if(session('status'))
    <div class="toast toast-top toast-start">
        <div class="alert alert-success">
          <span>{{ session('status') }}</span>
        </div>
      </div>
    @endif
    <div class="container mx-auto">
        <div class="card glass p-6">
            <span class="text-xl font-bold btn mb-4">Cart</span>
            <div class="flex flex-col gap-4">
                @foreach ($transactions as $transaction)
                @php
                    $totalBayar += $transaction->product->price * $transaction->quantity;
                @endphp
                <div class="card card-body bg-base-100 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-2 items-center">
                            <img src="{{ $transaction->product->photo }}" alt="none" class="w-24 h-24 rounded-lg">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold">Rp.{{ number_format($transaction->product->price) }} {{ $transaction->quantity }}x</span>
                                <span class="badge badge-outline">{{ $transaction->product->name }}</span>
                            </div>
                        </div>
                        <form action="/cancel-cart/{{ $transaction->id }}" method="post">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn">Cancel</button>
                        </form>
                    </div>
                </div>
            @endforeach
            </div>
           
        </div>
    </div>

    <div class="btm-nav bg-transparent">
    @if ($totalBayar != 0)
    <div class="flex">
        @if ($totalBayar > $saldo_user)
            <span>Saldo kurang: {{ $totalBayar - $saldo_user }}</span>
        @endif
        <form action="/buy-from-cart" method="post">
            @csrf
            @method('PUT')
            <span>Rp.{{ number_format($totalBayar) }}</span>
            <button type="submit" class="btn">Buy</button>
        </form>
    </div>
    @endif
       

    </div>
@endsection