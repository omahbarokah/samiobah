<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use Sluggable;

    protected $table = 'produk';

    protected $fillable = [
        'produk_nama', 'produk_slug', 'produk_stok', 'produk_diskon', 'produk_harga',
        'produk_deskripsi', 'produk_disembunyikan', 'produk_gambar',
    ];

    protected $casts = [
        'produk_stok' => 'integer',
        'produk_diskon' => 'integer',
        'produk_disembunyikan' => 'boolean',
        'produk_harga' => 'decimal:0'
    ];

    public static function search($keyword)
    {
        return self::query()->where('produk_nama', 'LIKE', '%' . $keyword . '%');
    }

    public function getHargaAttribute()
    {
        return 'Rp ' . number_format($this->produk_harga, 0, ',', '.');
    }

    public function getHargaDiskonAttribute()
    {
        return 'Rp ' . number_format($this->produk_harga_diskon, 0, ',', '.');
    }

    public function getProdukHargaDiskonAttribute()
    {
        return $this->produk_harga - $this->produk_diskon_harga;
    }

    public function getProdukDiskonHargaAttribute()
    {
        return (($this->produk_diskon / 100) * $this->produk_harga);
    }

    public function sluggable()
    {
        return [
            'produk_slug' => [
                'source' => 'produk_nama'
            ]
        ];
    }
}
