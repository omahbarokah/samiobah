<?php

namespace App\Providers;

use App\Pesanan;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('kelola-pengguna', function ($user) {
            return $user->peran === 'admin';
        });
        Gate::define('kelola-produk', function ($user) {
            return $user->peran === 'admin';
        });
        Gate::define('kelola-finansial', function ($user) {
            return $user->peran === 'admin';
        });
        Gate::define('kelola-transaksi', function ($user) {
            return in_array($user->peran, ['admin', 'staff']);
        });
        Gate::define('kelola-pesanan', function ($user) {
            return $user->peran === 'customer';
        });
        Gate::define('detail-pesanan', function($user, Pesanan $pesanan) {
            return ($user->peran === 'admin') || $user->id === $pesanan->user_id;
        });
        
        Gate::define('faktur-pesanan', function($user, Pesanan $pesanan) {
            return ($user->peran === 'admin') || $user->id === $pesanan->user_id;
        });
    }
}
