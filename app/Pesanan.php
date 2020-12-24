<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'user_id', 'pesanan_status', 'pesanan_catatan', 'pesanan_total_bayar',
    ];

    public function item()
    {
        return $this->hasMany(Item::class, 'pesanan_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function daftarItemInline()
    {
        return $this->item->map(function ($item) {
            return $item->produk->produk_nama . ' × ' . $item->item_jumlah;
        })->join(", ");
    }
}
