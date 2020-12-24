<div class="col-lg-3 col-md-4 col-sm-6 col-12 my-1">
    <div class="card shadow-sm">
        <img class="card-img-top" src="{{ asset($produk->produk_gambar) }}" style="height: 150px;object-fit: cover;">
        <div class="card-body">
            <h3 class="h5">
                <a href="{{ route('produk', compact('produk')) }}" class="text-body">{{ $produk->produk_nama }}</a>
                @if($produk->produk_diskon > 0)
                    <span class="text-white badge badge-primary badge-pill">Disc. {{ $produk->produk_diskon }}%</span>
                @endif
            </h3>
            @if($produk->produk_diskon > 0)
                <h4 class="h6">
                    <span class="text-success">{{ $produk->harga_diskon }}</span>
                    <strike class="text-muted small">{{ $produk->harga }}</strike>
                </h4>
            @else
                <h4 class="h6 text-success">{{ $produk->harga }}</h4>
            @endif
            @if($produk->produk_stok > 0)
                <span class="text-white badge badge-info badge-pill">{{ __('Masih :stok', ['stok' => $produk->produk_stok]) }}</span>
            @else
                <span class="text-white badge badge-secondary badge-pill">{{ __('Habis') }}</span>
            @endif
        </div>
    </div>
</div>
