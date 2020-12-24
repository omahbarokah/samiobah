<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimpanProduk;
use App\Http\Requests\UbahProduk;
use App\Item;
use App\Produk;
use Auth;
use File;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function daftarProduk(Request $request)
    {
        Gate::authorize('kelola-produk');

        $produkQuery = Produk::query();
        $queryFragments = [];

        if ($request->has('cari')) {
            $keyword = $request->get('cari');
            $queryFragments['cari'] = $keyword;
            $produkQuery = Produk::search($keyword);
        }

        $produk = $produkQuery->paginate()->appends($queryFragments);

        return view('produk.indeks', compact('produk'));
    }

    public function tambah()
    {
        Gate::authorize('kelola-produk');

        return view('produk.tambah');
    }

    public function simpan(SimpanProduk $request)
    {
        Gate::authorize('kelola-produk');

        $disembunyikan = $request->exists('produk_disembunyikan') ? 1 : 0;

        $produk = Produk::create($request->all(['produk_nama', 'produk_harga', 'produk_diskon', 'produk_deskripsi', 'produk_stok']) + ['produk_disembunyikan' => $disembunyikan]);

        if ($request->hasFile('produk_gambar')) {
            $gambar = $request->file('produk_gambar');
            $nama = Str::uuid() . '-' . Str::random(10) . '.' . $gambar->getClientOriginalExtension();

            if ($gambar->move(public_path('uploads'), $nama)) {
                $produk->update([
                    'produk_gambar' => '/uploads/' . $nama,
                ]);
            }
        }

        return redirect()->route('sunting.produk', compact('produk'))->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil menambahkan produk.')
        ]);
    }

    public function sunting(Produk $produk)
    {
        return view('produk.sunting', compact('produk'));
    }

    public function ubah(UbahProduk $request, Produk $produk)
    {
        Gate::authorize('kelola-produk');

        $disembunyikan = $request->exists('produk_disembunyikan') ? 1 : 0;

        if ($request->hasFile('produk_gambar')) {
            $gambarLama = $produk->produk_gambar;
            $gambar = $request->file('produk_gambar');
            $nama = Str::uuid() . '-' . Str::random(10) . '.' . $gambar->getClientOriginalExtension();

            if ($gambar->move(public_path('uploads'), $nama)) {
                $produk->update([
                    'produk_gambar' => '/uploads/' . $nama,
                ]);

                if ($gambarLama) {
                    File::delete(public_path($gambarLama));
                }
            }
        }

        $produk->update($request->all(['produk_nama', 'produk_harga', 'produk_diskon', 'produk_deskripsi', 'produk_stok']) + ['produk_disembunyikan' => $disembunyikan]);

        return redirect()->route('sunting.produk', compact('produk'))->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil mengubah data produk.')
        ]);
    }

    public function hapus(Produk $produk)
    {
        Gate::authorize('kelola-produk');

        $gambar = $produk->produk_gambar;

        if ($gambar && File::exists(public_path($gambar))) {
            File::delete(public_path($gambar));
        }

        $produk->delete();

        return redirect()->route('kelola.produk')->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil menghapus data produk.')
        ]);
    }

    public function lihat(Produk $produk)
    {
        return view('produk.lihat', compact('produk'));
    }

    public function masukKeranjang(Request $request, Produk $produk)
    {
        Gate::authorize('kelola-pesanan');

        $data = $this->validate($request, [
            'item_jumlah' => ['required', 'integer', 'min:1', 'max:' . $produk->produk_stok],
        ]);

        $keranjang = Auth::user()->keranjang();
        $item = $keranjang->item()->where('produk_id', '=', $produk->id);

        if ($item->exists()) {
            if (($item->first()->item_jumlah + (int)$data['item_jumlah']) > $produk->produk_stok) {
                return redirect()->back()->with('notice', [
                    'type' => 'danger',
                    'dismissible' => true,
                    'text' => __('Jumlah melebihi stok.')
                ]);
            }

            $keranjang->item->map(function ($item) use ($data, $produk) {
                if ($item->produk_id === $produk->id) {
                    if ($produk->produk_harga != $item->item_harga) {
                        $item->item_harga = $produk->produk_harga;
                    }

                    if ($produk->produk_diskon != $item->item_diskon) {
                        $item->item_diskon = $produk->produk_diskon;
                    }

                    $item->item_jumlah += (int)$data['item_jumlah'];
                    $item->item_total_harga = $produk->produk_harga_diskon * $item->item_jumlah;
                    $item->save();
                }
                return $item;
            });
        } else {
            Item::create([
                'produk_id' => $produk->id,
                'pesanan_id' => $keranjang->id,
                'item_jumlah' => $data['item_jumlah'],
                'item_harga' => $produk->produk_harga,
                'item_diskon' => $produk->produk_diskon,
                'item_total_harga' => $produk->produk_harga_diskon * (int)$data['item_jumlah']
            ]);
        }

        $keranjang->update([
            'pesanan_total_bayar' => $keranjang->item()->sum('item_total_harga')
        ]);

        return redirect()->back()->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil menambahkan ke keranjang.')
        ]);
    }

    public function ubahItemKeranjang(Request $request, Produk $produk)
    {
        Gate::authorize('kelola-pesanan');

        $data = $this->validate($request, [
            'item_jumlah' => ['required', 'integer', 'min:0', 'max:' . $produk->produk_stok],
        ]);

        $keranjang = Auth::user()->keranjang();
        $item = $keranjang->item()->where('produk_id', '=', $produk->id);

        if ($item->exists()) {
            if ((int)$data['item_jumlah'] > $produk->produk_stok) {
                return redirect()->back()->with('notice', [
                    'type' => 'danger',
                    'dismissible' => true,
                    'text' => __('Jumlah melebihi stok.')
                ]);
            }

            if ((int)$data['item_jumlah'] === 0) {
                try {
                    $item->first()->delete();
                } catch (\Exception $e) {
                    return redirect()->back()->with('notice', [
                        'type' => 'success',
                        'dismissible' => true,
                        'text' => __('Gagal menghapus item dari keranjang.')
                    ]);
                }
            } else {
                $keranjang->item->map(function ($item) use ($data, $produk) {
                    if ($item->produk_id === $produk->id) {
                        if ($produk->produk_harga != $item->item_harga) {
                            $item->item_harga = $produk->produk_harga;
                        }

                        if ($produk->produk_diskon != $item->item_diskon) {
                            $item->item_diskon = $produk->produk_diskon;
                        }

                        $item->item_jumlah = (int)$data['item_jumlah'];
                        $item->item_total_harga = $produk->produk_harga_diskon * $item->item_jumlah;
                        $item->save();
                    }
                    return $item;
                });
            }
        } else {
            Item::create([
                'produk_id' => $produk->id,
                'pesanan_id' => $keranjang->id,
                'item_jumlah' => $data['item_jumlah'],
                'item_harga' => $produk->produk_harga,
                'item_diskon' => $produk->produk_diskon,
                'item_total_harga' => $produk->produk_harga_diskon * (int)$data['item_jumlah']
            ]);
        }

        $keranjang->update([
            'pesanan_total_bayar' => $keranjang->item()->sum('item_total_harga')
        ]);

        return redirect()->back()->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil mengubah item keranjang.')
        ]);
    }

    public function hapusDariKeranjang(Produk $produk)
    {
        $keranjang = Auth::user()->keranjang();
        $item = $keranjang->item()->where('produk_id', '=', $produk->id);

        if ($item->exists()) {
            try {
                $item->first()->delete();
            } catch (\Exception $e) {
                return redirect()->back()->with('notice', [
                    'type' => 'success',
                    'dismissible' => true,
                    'text' => __('Gagal menghapus item dari keranjang.')
                ]);
            }
        }

        $keranjang->update([
            'pesanan_total_bayar' => $keranjang->item()->sum('item_total_harga')
        ]);

        return redirect()->back()->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil menghapus item dari keranjang.')
        ]);
    }
}
