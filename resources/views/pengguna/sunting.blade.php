@extends('layouts.admin')

@section('title', __('Sunting Pengguna'))

@section('admin.content')
    <div class="col-md-8">
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('kelola.pengguna') }}" class="btn btn-link">&laquo; {{ __('Kembali') }}</a>
            <a href="{{ route('buat.pengguna') }}" class="btn btn-outline-primary">{{ __('Buat Baru') }}</a>
        </div>
        <div class="card">
            <div class="card-header">{{ __('Detail Pengguna') }}</div>
            <div class="card-body">
                <form action="{{ route('sunting.pengguna', compact('pengguna')) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $pengguna->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $pengguna->email }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kontak" class="col-md-4 col-form-label text-md-right">{{ __('No. HP') }}</label>

                        <div class="col-md-6">
                            <input id="kontak" type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{ $pengguna->kontak }}" pattern="^08[\d]{10,14}" autocomplete="off">

                            @error('kontak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Rumah') }}</label>

                        <div class="col-md-6">
                            <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" autocomplete="off">{{ $pengguna->alamat }}</textarea>

                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="peran" class="col-md-4 col-form-label text-md-right">{{ __('Peran') }}</label>

                        <div class="col-md-6">
                            <select id="peran" class="form-control @error('peran') is-invalid @enderror" name="peran" required>
                                <option value="customer" @if($pengguna->peran === 'customer') selected @endif>{{ __('Pelanggan') }}</option>
                                <option value="admin" @if($pengguna->peran === 'admin') selected @endif>{{ __('Admin') }}</option>
                                <option value="staff" @if($pengguna->peran === 'staff') selected @endif>{{ __('Karyawan/Karyawati') }}</option>
                            </select>

                            @error('peran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
