@extends('layouts.admin')

@section('title', __('Keranjang'))

@section('admin.content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Keranjang Anda') }}</div>
            <div class="card-body">
                @if(auth()->user()->keranjang()->item->isNotEmpty())
                    <div class="py-2 table-responsive mb-1">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <td>{{ __('Nama Produk') }}</td>
                                    <td>{{ __('Harga') }}</td>
                                    <td>{{ __('Jumlah') }}</td>
                                    <td>{{ __('Total') }}</td>
                                    <td>{{ __('Stok') }}</td>
                                    <td>{{ __('Diskon') }}</td>
                                    <td>{{ __('Bayar') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total_bayar = 0)
                                @foreach(auth()->user()->keranjang()->item as $item)
                                    @php($harga_diskon = ($item->produk->produk_harga_diskon * $item->item_jumlah))
                                    @php($total_harga = ($item->produk->produk_harga * $item->item_jumlah))
                                    @php($total_bayar += $harga_diskon)
                                    <tr class="@if($item->item_jumlah > $item->produk->produk_stok) table-danger @endif">
                                        <td>
                                            <a href="{{ route('produk', ['produk' => $item->produk]) }}">{{ $item->produk->produk_nama  }}</a>
                                        </td>
                                        <td>{{ 'Rp ' . number_format($item->produk->produk_harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->item_jumlah }}</td>
                                        <td>{{ 'Rp ' . number_format($total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->produk->produk_stok > 0 ? 'Ada' : 'Kosong' }}</td>
                                        <td>{{ $item->produk->produk_diskon }}%</td>
                                        <td>{{ 'Rp ' . number_format($harga_diskon, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">{{ __('Subtotal') }}</td>
                                    <td>{{ 'Rp ' . number_format($total_bayar, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @if(auth()->user()->keranjang()->item->every(function ($item) {return $item->item_jumlah > $item->produk->produk_stok;}))
                        @if(auth()->user()->keranjang()->item->isNotEmpty())
                            <x-alert :text="__('Ups ada produk yang sudah habis/berkurang stoknya.')" type="warning"></x-alert>
                        @endif
                    @else
                        <form action="{{ route('keranjang.pesanan') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">{{ __('Checkout Pesanan') }} &raquo;
                                </button>
                            </div>
                        </form>
                    @endif
                @else
                    <x-alert :text="__('Keranjang anda kosong.')" type="info"></x-alert>
                @endif
            </div>
        </div>
    </div>
@endsection
