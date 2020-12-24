@extends('layouts.admin')

@section('title', __('Kelola Pengguna'))

@section('admin.content')
    <div class="col-md-8" x-data="dataPengguna()">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('buat.pengguna') }}" class="btn btn-outline-primary">{{ __('Buat Pengguna') }}</a>
        </div>
        <div class="card">
            <div class="card-header">{{ __('Daftar Pengguna') }}</div>
            <div class="card-body">
                <form class="d-flex justify-content-end" action="{{ route(Route::currentRouteName()) }}" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="{{ __('Cari siapa...') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">{{ __('Cari') }}</button>
                        </div>
                    </div>
                </form>
                <div class="py-2 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Nama') }}</td>
                                <td>{{ __('Peran') }}</td>
                                <td>{{ __('Alamat E-Mail') }}</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @each('pengguna.indeks.baris', $users, 'pengguna', 'pengguna.indeks.kosong')
                        </tbody>
                        <tfoot class="border-bottom">
                            <tr>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Nama') }}</td>
                                <td>{{ __('Peran') }}</td>
                                <td>{{ __('Alamat E-Mail') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="pt-2 d-flex justify-content-center">
                    @if($users->lastPage() == 1)
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled"><span class="page-link">‹</span></li>
                                <li class="page-item active"><span class="page-link">1</span></li>
                                <li class="page-item disabled"><span class="page-link">›</span></li>
                            </ul>
                        </nav>
                    @else
                        {{ $users->links() }}
                    @endif
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-penghapusan" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" x-bind:action="action" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Konfirmasi Penghapusan') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ __('Anda yakin ingin menghapus pengguna ini? Semua data yang berelasi akan ikut terhapus!') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Tidak') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Hapus') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('body.scripts')
    <script type="text/javascript">
        function dataPengguna() {
            return {
                action: '',
                konfirmasiPenghapusan($el) {
                    this.action = $el.href;
                }
            }
        }
    </script>
@endpush
