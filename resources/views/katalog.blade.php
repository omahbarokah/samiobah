@extends('layouts.admin')

@section('admin.content')
    @each('katalog.item', $produk, 'produk', 'katalog.kosong')
@endsection

@push('body.scripts')
    <div class="pt-2 d-flex justify-content-center">
        @if($produk->lastPage() == 1)
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled"><span class="page-link">‹</span></li>
                    <li class="page-item active"><span class="page-link">1</span></li>
                    <li class="page-item disabled"><span class="page-link">›</span></li>
                </ul>
            </nav>
        @else
            {{ $produk->links() }}
        @endif
    </div>
@endpush
