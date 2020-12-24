@extends('layouts.admin')

@section('title', __('Tambah Produk'))

@section('admin.content')
    <div class="col-md-8" x-data="dataProduk()">
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('kelola.produk') }}" class="btn btn-link">&laquo; {{ __('Kembali') }}</a>
            <a href="{{ route('tambah.produk') }}" class="btn btn-outline-primary">{{ __('Tambah Baru') }}</a>
        </div>
        <div class="card">
            <div class="card-header">{{ __('Detail Produk') }}</div>
            <div class="card-body">
                <form action="{{ route(Route::currentRouteName(), compact('produk')) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-2">
                        <label for="produk_nama" class="sr-only">{{ __('Nama') }}</label>
                        <input id="produk_nama" type="text" name="produk_nama" class="form-control form-control-lg @error('produk_nama') is-invalid @enderror" placeholder="{{ __('Nama Produk') }}" required value="{{ $produk->produk_nama }}">
                        @error('produk_nama')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 row align-items-center">
                        <div class="col-md-6 mb-2 col-12">
                            <label for="produk_stok">{{ __('Stok') }}</label>
                            <input id="produk_stok" type="number" class="form-control @error('produk_stok') is-invalid @enderror" required min="0" name="produk_stok" value="{{ $produk->produk_stok }}">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="produk_disembunyikan">{{ __('Visibilitas Produk') }}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="produk_disembunyikan" id="produk_disembunyikan" @if($produk->produk_disembunyikan) checked @endif>
                                <label class="form-check-label" for="produk_disembunyikan">{{ __('Sembunyikan') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <div class="col-md-6 mb-2 col-12">
                            <label for="produk_harga">{{ __('Harga') }}</label>
                            <input id="produk_harga" type="number" class="form-control @error('produk_harga') is-invalid @enderror" required min="0" name="produk_harga" value="{{ $produk->produk_harga }}">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="produk_diskon">{{ __('Diskon') }}</label>
                            <input id="produk_diskon" type="number" class="form-control @error('produk_diskon') is-invalid @enderror" required min="0" name="produk_diskon" value="{{ $produk->produk_diskon }}">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <div class="col-md-4 mb-2 col-12">
                            <template x-if="gambarURL">
                                <img x-bind:src="gambarURL" class="img-thumbnail rounded mx-auto d-block mb-2">
                            </template>
                            <div class="custom-file">
                                <label for="produk_gambar">Gambar</label>
                                <input type="file" class="form-control-file" x-ref="gambar" @change="prosesGambar" id="produk_gambar" name="produk_gambar" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <label for="produk_deskripsi">{{ __('Deskripsi') }}</label>
                            <textarea class="form-control @error('produk_deskripsi') is-invalid @enderror" name="produk_deskripsi" id="produk_deskripsi">{!! $produk->produk_deskripsi !!}</textarea>
                            @error('produk_deskripsi')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('head.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.3.2/tinymce.min.js"></script>
@endpush

@push('body.scripts')
    <script type="text/javascript">
        tinymce.init({
            selector: '#produk_deskripsi'
        });

        function dataProduk() {
            return {
                gambarURL: '{{ $produk->produk_gambar ? asset($produk->produk_gambar) : '' }}',
                prosesGambar() {
                    const {files} = this.$refs.gambar;
                    if (files.length > 0) {
                        const file = files[0];

                        if (/^image/.test(file.type)) {
                            this.gambarURL = URL.createObjectURL(file);
                        }
                    } else {
                        this.gambarURL = '';
                    }
                }
            }
        }
    </script>
@endpush
