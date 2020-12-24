<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" width="30" height="30" alt="{{ config('app.name', 'SAMI OBAH') }}" loading="lazy">
                <span class="align-middle">{{ config('app.name', 'SAMI OBAH') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation-bar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('katalog') }}">{{ __('Katalog') }}</a>
                    </li>
                    @auth
                        @php($menunggu = \App\Pesanan::where('pesanan_status', '=', 'menunggu-konfirmasi')->count())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="kelola" role="button" data-toggle="dropdown">
                                <span>{{ __('Menu') }}</span>
                                @can('kelola-transaksi')
                                    <span class="badge badge-danger badge-pill">{{ $menunggu }}</span>
                                @endcan
                            </a>
                            <div class="dropdown-menu shadow-sm">
                                @if(Gate::check('kelola-pengguna') && Gate::check('kelola-produk'))
                                    <small class="dropdown-item-text text-muted">{{ __('Kelola') }}</small>
                                    <a class="dropdown-item" href="{{ route('kelola.pengguna') }}">{{ __('Pengguna') }}</a>
                                    <a class="dropdown-item" href="{{ route('kelola.produk') }}">{{ __('Produk') }}</a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <small class="dropdown-item-text text-muted">{{ __('Transaksi') }}</small>
                                @can('kelola-pesanan')
                                    <a class="dropdown-item" href="{{ route('kelola.pesanan') }}">{{ __('Pesanan') }}</a>
                                @endcan
                                @can('kelola-transaksi')
                                    <a class="dropdown-item" href="{{ route('kelola.pesanan') }}">
                                        <span>{{ __('Pesanan') }}</span>
                                        <span class="badge badge-danger badge-pill">{{ $menunggu }}</span>
                                    </a>
                                    <a class="dropdown-item" href="#">{{ __('Rekap Harian') }}</a>
                                @endcan
                                @can('kelola-finansial')
                                    <div class="dropdown-divider"></div>
                                    <small class="dropdown-item-text text-muted">{{ __('Finansial') }}</small>
                                    <a class="dropdown-item" href="#">{{ __('Neraca Keuangan') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Hutang Piutang') }}</a>
                                @endcan
                            </div>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @can('kelola-pesanan')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <div class="d-inline-block">
                                        <span>{{ __('Keranjang') }}</span>
                                        @if(auth()->user()->keranjang()->item->isNotEmpty())
                                            <span class="badge badge-pill badge-success">{{ auth()->user()->keranjang()->item->count() }}</span>
                                        @endif
                                    </div>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu shadow-sm dropdown-menu-right">
                                    @if(auth()->user()->keranjang()->item->isNotEmpty())
                                        @foreach(auth()->user()->keranjang()->item as $item)
                                            <div class="dropdown-item-text small">
                                                {{ $item->produk->produk_nama }} &times; {{ $item->item_jumlah }}</div>
                                        @endforeach
                                    @else
                                        <small class="dropdown-item-text">{{ __('Ups keranjang kamu masih kosong.') }}</small>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-center" href="{{ route('keranjang.pesanan') }}">{{ __('Lihat Keranjang') }} &raquo;</a>
                                </div>
                            </li>
                        @endcan
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <span>{{ __('Hai, :name', ['name' => Str::before(trim(Auth::user()->name), ' ')]) }}</span>
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu shadow-sm dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Keluar') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
