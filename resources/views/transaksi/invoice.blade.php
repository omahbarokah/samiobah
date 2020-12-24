@extends('layouts.admin')

@section('title', __('Invoice'))

@section('admin.content')
    <div class="col-12">  
        
        @if($pesanan->item->isNotEmpty()) 
            <section class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
            <div class="col-12">
                <h4 class="page-header">
                <img src="{{ asset('img/cart.svg') }}" width="32" height="32"/> OmahBarokah.

                <small class="float-right text-sm">Tanggal: {{Carbon\Carbon::now()->toDateTimeString()}}</small>
                </h4>
            </div>
            <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
            <div class="col-sm-4 invoice-col"> 
                <address>
                <strong>OmahBarokah.</strong><br>
                Ndalem Kasuranan<br>
                Kembaran RT. 03<br>
                Kasihan Yogyakarta<br>
                WA: 0874 7972 0004<br> 
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Kepada
                <address>
                <strong>Pelanggan</strong><br> 
                
                ------------------------
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #001</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br> 
                <b>Akun:</b> 000-000-001<br>  
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        
            <!-- Table row -->
            <div class="row">

            <div class="col-12 table-responsive">
                <table class="table table-striped">
                
                            <thead>
                                <tr>
                                    <td>{{ __('Nama Produk') }}</td>
                                    <td>{{ __('Harga @') }}</td>
                                    <td>{{ __('Qty') }}</td>
                                    <td>{{ __('Diskon') }}</td>
                                    <td>{{ __('Total') }}</td> 
                                </tr>
                            </thead>
                            <tbody>
                                @php($total_bayar = 0)
                                @foreach($pesanan->item as $item)
                                    @php($harga_diskon = ($item->produk->produk_harga_diskon * $item->item_jumlah))
                                    @php($total_harga = ($item->produk->produk_harga * $item->item_jumlah))
                                    @php($total_bayar += $harga_diskon)
                                    <tr class="@if($item->item_jumlah > $item->produk->produk_stok) table-danger @endif">
                                        <td>
                                            {{ $item->produk->produk_nama  }} 
                                        </td>
                                        <td>{{ 'Rp ' . number_format($item->produk->produk_harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->item_jumlah }}</td>
                                        <td>{{ $item->produk->produk_diskon }}%</td>
                                        <td>{{ 'Rp ' . number_format($harga_diskon, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody> 
                </table>
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        
            <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="lead">Pembayaran ditransfter ke:</p> 
        
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"> 
                    <del>Jono</del> Achmad <br>
                    BSM : 7029240358<br>
                    BNI : 0101851232<br>
                    BCA : 1691921676<br>
                </p>
            </div>
            <!-- /.col -->
            <div class="col-6">  
                <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td> {{ 'Rp ' . number_format($total_bayar, 0, ',', '.') }}</td> 
                    </tr> 
                    <tr>
                        <th>Shipping:</th>
                        <td>{{ 'Rp ' . number_format(15000, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>{{ 'Rp ' . number_format($total_bayar + 15000, 0, ',', '.') }}</td>
                    </tr>
                </tbody></table>
                </div>
            </div> 
            </div> 
        @else
            <x-alert :text="__('Keranjang anda kosong.')" type="info"></x-alert>
        @endif
      </section>
@endsection
