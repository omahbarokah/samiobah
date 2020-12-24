<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        Gate::authorize('kelola-pesanan');

        return view('keranjang.lihat');
    }

    public function checkoutPesanan()
    {
        Gate::authorize('kelola-pesanan');

        $keranjang = auth()->user()->keranjang();

        if ($keranjang->item->isEmpty()) {
            return redirect()->back()->with('notice', [
                'type' => 'warning',
                'dimissible' => true,
                'text' => __('Keranjang anda kosong.')
            ]);
        } else {
            if ($keranjang->item->every(function ($item) {
                return $item->item_jumlah > $item->produk->produk_stok;
            })) {
                return redirect()->back()->with('notice', [
                    'type' => 'warning',
                    'dismissible' => true,
                    'text' => __('Ups ada produk yang sudah habis/berkurang stoknya.')
                ]);
            }

            $keranjang->item->map(function ($item) {
                $produk = $item->produk;
                $item->item_diskon = $produk->produk_diskon;
                $item->item_harga = $produk->produk_harga;
                $item->item_total_harga = ($produk->produk_harga_diskon * $item->item_jumlah);
                $item->save();
            });

            $keranjang->update([
                'pesanan_total_bayar' => $keranjang->item()->sum('item_total_harga')
            ]);

            if ($keranjang->update(['pesanan_status' => 'menunggu-konfirmasi'])) {
                $keranjang->item->map(function ($item) {
                    $produk = $item->produk;
                    $produk->update([
                        'produk_stok' => $produk->produk_stok - $item->item_jumlah
                    ]);
                });

                return redirect()->back()->with('notice', [
                    'type' => 'success',
                    'dismissible' => true,
                    'text' => __('Berhasil checkout pesanan, silahkan tunggu konfirmasi.')
                ]);
            }
        }
    }
}
