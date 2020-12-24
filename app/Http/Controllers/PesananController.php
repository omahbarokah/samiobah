<?php

namespace App\Http\Controllers;

use App\Pesanan;
use Gate;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function lihat()
    {
        if (Gate::allows('kelola-transaksi')) {
            return $this->konfirmasi();
        } else if (Gate::allows('kelola-pesanan')) {

        }

        abort(503);
    }

    public function konfirmasi()
    {
        $pesanan = Pesanan::wherePesananStatus('menunggu-konfirmasi')->paginate();

        return view('transaksi.konfirmasi', compact('pesanan'));
    }

    public function konfirmasiPesanan(Pesanan $pesanan)
    {
        if ($pesanan->pesanan_status != 'menunggu-konfirmasi') {
            return redirect()->back()->with('notice', [
                'text' => __('Pesanan telah melewati tahap konfirmasi.'),
                'dismissible' => true,
                'type' => 'info'
            ]);
        }

        $pesanan->update([
            'pesanan_status' => 'diproses'
        ]);

        return redirect()->back()->with('notice', [
            'text' => __('Pesanan berhasil dikonfirmasi. Status sekarang "Diproses".'),
            'dismissible' => true,
            'type' => 'success'
        ]);
    }

    public function batal(Pesanan $pesanan)
    {
        $pesanan->update([
            'pesanan_status' => 'dibatalkan'
        ]);

        $pesanan->item->each(function ($item) {
            $item->produk->produk_stok += $item->item_jumlah;
            $item->save();
        });

        return redirect()->back()->with('notice', [
            'text' => __('Pesanan dibatalkan.'),
            'dismissible' => true,
            'type' => 'success'
        ]);
    }

    public function detail(Pesanan $pesanan)
    {
        Gate::authorize('detail-pesanan', $pesanan);

        return view('transaksi.detail', compact('pesanan'));
    }
}
