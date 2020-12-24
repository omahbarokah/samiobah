@extends('layouts.admin')

@section('title', $produk->produk_nama)

@section('admin.content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-3">{{ $produk->produk_nama }}</h3>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                        <img class="img-thumbnail mb-4" alt="{{ $produk->produk_nama }}" src="{{ asset($produk->produk_gambar) }}">
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        @auth
                            @can('kelola-pesanan')
                                @if($produk->produk_stok < 1)
                                    <x-alert type="danger" :text="__('Maaf stok produk habis.')"></x-alert>
                                @else
                                    <form action="{{ route('produk', compact('produk')) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>{{ __('Tersedia:') }}</td>
                                                <td>{{ $produk->produk_stok }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Harga:') }}</td>
                                                <td>{{ $produk->harga }}</td>
                                            </tr>
                                            @if($produk->produk_diskon > 0)
                                                <tr>
                                                    <td>{{ __('Diskon:') }}</td>
                                                    <td>{{ $produk->produk_diskon }}
                                                        % {{ __('menjadi :harga', ['harga' => $produk->harga_diskon]) }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="align-middle">
                                                    <label for="item_jumlah" class="m-0">{{ __('Jumlah:') }}</label>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input id="item_jumlah" name="item_jumlah" type="number" class="form-control" value="1" step="1" @if($produk->produk_stok < 1) disabled @else min="1" max="{{ $produk->produk_stok }}" @endif required>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">{{ __('Tambahkan ke Keranjang') }}</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                @endif
                                @if(auth()->user()->keranjang()->item()->where('produk_id', '=', $produk->id)->exists())
                                    <form action="{{ route('produk', compact('produk')) }}" method="post" class="p-2 border">
                                        @csrf
                                        @if($produk->produk_stok < 1)
                                            @method('DELETE')
                                        @else
                                            @method('PATCH')
                                        @endif
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <td class="align-middle">
                                                    <label for="item_jumlah" class="m-0">{{ __('Keranjang:') }}</label>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input id="item_jumlah" name="item_jumlah" type="number" value="{{ auth()->user()->keranjang()->item()->where('produk_id', '=', $produk->id)->first()->item_jumlah }}" class="form-control" step="1" @if($produk->produk_stok < 1) disabled @else min="0" max="{{ $produk->produk_stok }}" @endif required>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if($produk->produk_stok < 1)
                                                        <button type="submit" class="btn btn-danger">{{ __('Hapus dari Keranjang') }}</button>
                                                    @else
                                                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                @endif
                            @elsecan('kelola-transaksi')
                                <x-alert :text="__('Admin dan Karyawan tidak dapat melakukan pembelian.')" type="info"></x-alert>
                            @endcan
                        @else
                            <x-alert :text="__('Silahkan login untuk melakukan pemesanan.')" type="info"></x-alert>
                        @endauth
                    </div>
                </div>
                <hr>
                <small class="text-muted mb-2 d-block">{{ __('Deskripsi') }}</small>
                <div>
                    {!! $produk->produk_deskripsi ?? '<p>Tidak ada deskripsi untuk produk ini.</p>' !!}
                </div>
            </div>
        </div>
    </div>
@endsection
