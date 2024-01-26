<!doctype html>
<html data-theme="corporate">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>EFintech</title>
</head>
<body>
    <div class="flex flex-col lg:flex-row navbar bg-base-100 fixed top-0">
        <div class="flex-1">
          <a href="/" class="btn btn-ghost text-xl">EFintech</a>
        </div>
        <div class="flex-none">
          <ul class="menu menu-horizontal px-1">
            @if (Auth::user()->roles_id == 1)
            <li><a href="/history">History</a></li>
            <li><a href="/transaksi-harian">Transaksi Harian</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="/logout">Logout</a></li>
            @elseif (Auth::user()->roles_id == 2)
            <li><a href="/history">History</a></li>
            <li><a href="/transaksi-harian">Transaksi Harian</a></li>
            <li><a href="/logout">Logout</a></li>
            @else
            <li><a href="/transaksi-harian">Transaksi Harian</a></li>
            <li><a href="/logout">Logout</a></li>
            @endif

          </ul>
        </div>
      </div>
      <div class="mb-24 lg:mb-14"></div>
      @yield('content')
</body>
</html>
