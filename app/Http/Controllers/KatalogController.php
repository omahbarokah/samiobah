<?php

namespace App\Http\Controllers;

use App\Produk;

class KatalogController extends Controller
{
    public function __invoke()
    {
        $produkQuery = Produk::query()->where('produk_disembunyikan', '=', '0');
        $produk = $produkQuery->paginate();

        return view('katalog', compact('produk'));
    }
}
