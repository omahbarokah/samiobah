@extends('layouts.admin')

@section('title', __('Buat Pengguna'))

@section('admin.content')
    <div class="col-md-8">
        <div class="d-flex justify-content-start mb-2">
            <a href="{{ route('kelola.pengguna') }}" class="btn btn-link">&laquo; {{ __('Kembali') }}</a>
        </div>
        <div class="card">
            <div class="card-header">{{ __('Detail Pengguna') }}</div>
            <div class="card-body">
                <form action="{{ route('buat.pengguna') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            <input id="kontak" type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{ old('kontak') }}" pattern="^08[\d]{10,14}" autocomplete="off">

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
                            <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" autocomplete="off">{{ old('alamat') }}</textarea>

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
                                <option value="customer">{{ __('Pelanggan') }}</option>
                                <option value="admin">{{ __('Admin') }}</option>
                                <option value="staff">{{ __('Karyawan/Karyawati') }}</option>
                            </select>

                            @error('peran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Buat') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
