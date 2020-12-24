<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimpanPengguna;
use App\Http\Requests\UbahPengguna;
use App\User as Pengguna;
use Gate;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function daftarPengguna(Request $request)
    {
        Gate::authorize('kelola-pengguna');

        $userQuery = Pengguna::query();
        $queryFragments = [];

        if ($request->has('cari')) {
            $keyword = $request->get('cari');
            $queryFragments['cari'] = $keyword;
            $userQuery = Pengguna::search($keyword);
        }

        $users = $userQuery->paginate()->appends($queryFragments);

        return view('pengguna.indeks', compact('users'));
    }

    public function buat()
    {
        Gate::authorize('kelola-pengguna');

        return view('pengguna.buat');
    }

    public function simpan(SimpanPengguna $request)
    {
        Gate::authorize('kelola-pengguna');

        $password = \Hash::make($request->get('password'));
        $pengguna = Pengguna::create($request->all(['name', 'email', 'alamat', 'peran', 'kontak']) + compact('password'));

        return redirect()->route('sunting.pengguna', compact('pengguna'));
    }

    public function sunting(Pengguna $pengguna)
    {
        Gate::authorize('kelola-pengguna');

        return view('pengguna.sunting', compact('pengguna'));
    }

    public function ubah(UbahPengguna $request, Pengguna $pengguna)
    {
        Gate::authorize('kelola-pengguna');

        if ($pengguna->email != $request->get('email')) {
            $this->validate($request, [
                'email' => ['unique:users'],
            ]);
        }

        $pengguna->update($request->all(['name', 'email', 'alamat', 'peran', 'kontak']));

        if ($request->get('password')) {
            $pengguna->update(['password' => \Hash::make($request->get('password'))]);
        }

        return redirect()->route('sunting.pengguna', compact('pengguna'))
            ->with('notice', [
                'type' => 'success',
                'dismissible' => true,
                'text' => __('Berhasil mengubah data pengguna.'),
            ]);
    }

    public function hapus(Pengguna $pengguna)
    {
        Gate::authorize('kelola-pengguna');

        $pengguna->delete();

        return redirect()->route('kelola.pengguna')->with('notice', [
            'type' => 'success',
            'dismissible' => true,
            'text' => __('Berhasil menghapus pengguna.'),
        ]);
    }
}
