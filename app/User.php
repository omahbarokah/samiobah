<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'kontak', 'alamat', 'peran',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function search($keyword)
    {
        return self::query()->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('kontak', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
    }

    public function getPeranPenggunaAttribute()
    {
        $roles = [
            'admin' => 'Admin',
            'staff' => 'Karyawan',
            'customer' => 'Pelanggan',
        ];

        return $roles[$this->peran];
    }

    public function keranjang()
    {
        return Pesanan::firstOrCreate([
            'user_id' => $this->id,
            'pesanan_status' => 'keranjang'
        ]);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'user_id', 'id');
    }
}
