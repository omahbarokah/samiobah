@extends('layouts.admin')

@section('title', __('Konfirmasi Pesanan Masuk'))

@section('admin.content')
    <div class="col-md-8" x-data="init()">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('kelola.pesanan') }}">{{ __('Konfirmasi') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('Proses') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('Selesai') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('Dibatalkan') }}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive py-2">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Dari') }}</td>
                                <td>{{ __('Pesanan') }}</td>
                                <td>{{ __('Aksi') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan as $keranjang)
                                <tr>
                                    <td>{{ $keranjang->id }}</td>
                                    <td>{{ $keranjang->customer->name }}</td>
                                    <td>{{ $keranjang->daftarItemInline() }}</td>
                                    <td>
                                        <a href="{{ route('detail.pesanan', ['pesanan' => $keranjang]) }}" class="btn btn-sm btn-success">{{ __('Detail') }}</a>
                                        <a href="{{ route('konfirmasi.pesanan', ['pesanan' => $keranjang]) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-konfirmasi" @click="konfirmasi($event.target)">{{ __('Konfirmasi') }}</a>
                                        <a href="{{ route('pesanan.batal', ['pesanan' => $keranjang]) }}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-tolak" @click="tolak($event.target)">{{ __('Tolak') }}</a>
                                        <a href="{{ route('faktur.pesanan', ['pesanan' => $keranjang]) }}" class="btn btn-sm btn-secondary">{{ __('Faktur') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pesanan->links() }}
            </div>
        </div>
        <div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" x-bind:action="action" method="post">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Konfirmasi') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ __('Konfirmasi Pesanan? Pesanan akan dilanjutkan ke "Proses"') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Kembali') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Ya') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modal-tolak" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" x-bind:action="action" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Konfirmasi Penolakan') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ __('Tolak atau Batalkan pesanan. Setelah ditolak stok akan dikembalikan.') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Kembali') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Ya') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('body.scripts')
    <script type="text/javascript">
        function init() {
            return {
                action: '',
                konfirmasi($el) {
                    this.action = $el.href;
                },
                tolak($el) {
                    this.action = $el.href;
                }
            }
        }
    </script>
@endpush
