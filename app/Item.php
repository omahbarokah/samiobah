<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'produk_id', 'pesanan_id', 'item_jumlah', 'item_harga',
        'item_diskon', 'item_total_harga',
    ];

    protected $casts = [
        'item_jumlah' => 'integer',
        'item_harga' => 'decimal:0',
        'item_diskon' => 'integer',
        'item_total_harga' => 'decimal:0'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
