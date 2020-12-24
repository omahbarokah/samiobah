<tr class="@if($item->produk_stok < 1) table-danger @elseif($item->produk_disembunyikan) table-secondary @endif">
    <td>{{ $item->id }}</td>
    <td>
        <a href="{{ route('produk', ['produk' => $item]) }}">{{ $item->produk_nama }}</a>
        @if($item->produk_diskon > 0)
            <span class="badge badge-success">{{ __('Diskon :diskon%', ['diskon' => $item->produk_diskon]) }}</span>
        @endif
    </td>
    <td>{{ $item->produk_stok }}</td>
    <td>
        @if($item->produk_diskon)
            <strike>{{ $item->harga }}</strike>
            <span class="badge badge-primary">{{ $item->harga_diskon }}</span>
        @else
            <span>{{ $item->harga }}</span>
        @endif
    </td>
    <td>
        <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">{{ __('Aksi') }}</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('sunting.produk', ['produk' => $item]) }}">Sunting</a>
                <a class="dropdown-item" href="{{ route('hapus.produk', ['produk' => $item]) }}" data-toggle="modal" data-target="#modal-penghapusan" @click="konfirmasiPenghapusan($event.target)">Hapus</a>
            </div>
        </div>
    </td>
</tr>
