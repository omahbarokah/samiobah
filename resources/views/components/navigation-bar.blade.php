
<nav class="main-header navbar navbar-expand-lg navbar-light bg-white ">
    @auth
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    @else
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" width="30" height="30" alt="{{ config('app.name', 'SAMI OBAH') }}" loading="lazy">
        <span class="align-middle text-bold">SAMI<span class="text-orange">OBAH</span></span>
    </a>

    @endauth
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation-bar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navigation-bar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('katalog') }}">{{ __('Katalog') }}</a>
            </li> 
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
</nav>


@auth
@php($menunggu = \App\Pesanan::where('pesanan_status', '=', 'menunggu-konfirmasi')->count())

<aside class="main-sidebar sidebar-light-primary elevation-2" style="z-index: 800">
    <a href="{{ url('/') }}" class="brand-link"> 
        <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'SAMI OBAH') }}" class="brand-image"
             style="opacity: .8"  loading="lazy"> 
        <span class="brand-text text-bold">SAMI<span class="text-orange">OBAH</span></span>
    </a>
    <div class="sidebar">  
    
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false"> 
                
                <li class="nav-header" hidden></li> 

                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
                        <i class="nav-icon fa fa-home-o"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li> 

                @if(Gate::check('kelola-pengguna') && Gate::check('kelola-produk')) 
                    <li class="nav-header">{{ __('Kelola') }}</li>  
                    <li class="nav-item">
                        <a href="{{ route('kelola.pengguna') }}" class="nav-link {{ Request::segment(2) === 'pengguna' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{ __('Pengguna') }}</p>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a href="{{ route('kelola.produk') }}" class="nav-link {{ Request::segment(2) === 'produk' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{ __('Produk')  }}</p>
                        </a>
                    </li>   
                @endif
                
                <li class="nav-header">{{ __('Transaksi') }}</li> 

                @can('kelola-pesanan') 
                    <li class="nav-item">
                        <a href="{{ route('kelola.pesanan') }}" class="nav-link {{ Request::segment(2) === 'pesanan' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{ __('Pesanan') }} 
                            </p>
                        </a>
                    </li> 
                @endcan
                @can('kelola-transaksi')  
                    <li class="nav-item">
                        <a href="{{ route('kelola.pesanan') }}" class="nav-link {{ Request::segment(2) === 'pesanan' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{  __('Pesanan') }}  <span class="right badge badge-danger">{{ $menunggu }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::segment(2) === 'rekap' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{ __('Rekap Harian') }} 
                            </p>
                        </a>
                    </li>
                @endcan
                @can('kelola-finansial')
                    <li class="nav-header">{{ __('Finansial') }}</li>

                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::segment(2) === 'neraca' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{ __('Neraca Keuangan') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::segment(2) === 'hutang' ? 'active' : null }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>{{ __('Hutang Piutang') }}
                            </p>
                        </a>
                    </li>
                @endcan 
            </ul>
        </nav> 
    </div> 
</aside>
 
@endauth

