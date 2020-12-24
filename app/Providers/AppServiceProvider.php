<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Mencegah kesalahan "SQLSTATE[42000]: Syntax error or access violation:
         * 1071 Specified key was too long;" pada saat migrasi database.
         */
        Schema::defaultStringLength(191);

        // Menggunakan InnoDB sebagai mesin MySQL bawaan.
        config([
            'database.connections.mysql.engine' => 'InnoDB',
        ]);

        // Mengatur "Asia/Jakarta" sebagai zona waktu bawaan.
        date_default_timezone_set('Asia/Jakarta');

        // Mengatur bahasa yang digunakan Carbon.
        Carbon::setLocale(config('app.locale', 'id'));
    }
}
