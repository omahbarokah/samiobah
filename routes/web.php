<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'KatalogController')->name('katalog');

Auth::routes([
    // Menonaktifkan rute untuk verifikasi akun.
    'verify' => false,
]);

Route::prefix('produk')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/{produk:produk_slug}', 'ProdukController@masukKeranjang');
        Route::patch('/{produk:produk_slug}', 'ProdukController@ubahItemKeranjang');
        Route::delete('/{produk:produk_slug}', 'ProdukController@hapusDariKeranjang');
    });
    Route::get('/{produk:produk_slug}', 'ProdukController@lihat')->name('produk');
});

Route::middleware('auth')->prefix('keranjang')->group(function () {
    Route::get('/', 'KeranjangController@keranjang')->name('keranjang.pesanan');
    Route::post('/', 'KeranjangController@checkoutPesanan');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', 'AdminController')->name('admin');
    Route::prefix('pengguna')->group(function () {
        Route::get('/', 'PenggunaController@daftarPengguna')->name('kelola.pengguna');
        Route::get('/buat', 'PenggunaController@buat')->name('buat.pengguna');
        Route::post('/buat', 'PenggunaController@simpan');
        Route::get('/{pengguna}', 'PenggunaController@sunting')->name('sunting.pengguna');
        Route::patch('/{pengguna}', 'PenggunaController@ubah');
        Route::delete('/{pengguna}', 'PenggunaController@hapus')->name('hapus.pengguna');
    });
    Route::prefix('produk')->group(function () {
        Route::get('/', 'ProdukController@daftarProduk')->name('kelola.produk');
        Route::get('/tambah', 'ProdukController@tambah')->name('tambah.produk');
        Route::post('/tambah', 'ProdukController@simpan');
        Route::get('/{produk:produk_slug}', 'ProdukController@sunting')->name('sunting.produk');
        Route::patch('/{produk:produk_slug}', 'ProdukController@ubah');
        Route::delete('/{produk:produk_slug}', 'ProdukController@hapus')->name('hapus.produk');
    });
    Route::prefix('pesanan')->group(function () {
        Route::get('/', 'PesananController@lihat')->name('kelola.pesanan');
        Route::get('/{pesanan}', 'PesananController@detail')->name('detail.pesanan');
        Route::get('/{pesanan}/faktur', 'PesananController@faktur')->name('faktur.pesanan');
        Route::post('/{pesanan}', 'PesananController@konfirmasiPesanan')->name('konfirmasi.pesanan');
        Route::patch('/{pesanan}', 'PesananController@selesai')->name('pesanan.selesai');
        Route::delete('/{pesanan}', 'PesananController@batal')->name('pesanan.batal');
    });
});

Route::fallback(function () {
    abort(404);
});
