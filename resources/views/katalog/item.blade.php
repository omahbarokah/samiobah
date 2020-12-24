<div class="col-lg-3 col-md-4 col-sm-6 col-12 my-1">
    <a href="{{ route('produk', compact('produk')) }}">
        <div class="card shadow-sm">
            @if($produk->produk_diskon > 0)
            <div class="ribbon-wrapper">
                <div class="ribbon bg-primary">
                    Diskon
                </div>
              </div> 
            @endif
            <img class="card-img-top" src="{{ asset($produk->produk_gambar) }}" style="height: 150px;object-fit: cover;">
            <div class="card-body" style="min-height: 200px;">
                <h3 class="h5">
                {{ $produk->produk_nama }}
                    @if($produk->produk_diskon > 0)
                        <span class="text-white badge badge-primary badge-pill">Disc. {{ $produk->produk_diskon }}%</span>
                    @endif
                </h3>
                @if($produk->produk_diskon > 0)
                    <del class="text-muted small">{{ $produk->harga }}</del>
                    <h6 class="h5">
                        <span class="text-success">{{ $produk->harga_diskon }}</span>
                    </h6>
                @else
                    <br>
                    <h4 class="h5 text-success">{{ $produk->harga }}</h4>
                @endif
                @if($produk->produk_stok > 0)
                    <span class="text-white badge badge-info badge-pill">{{ __('Masih :stok', ['stok' => $produk->produk_stok]) }}</span>
                @else
                    <span class="text-white badge badge-secondary badge-pill">{{ __('Habis') }}</span>
                @endif
            </div>
        </div>
    </a>
</div>
