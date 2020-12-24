<tr>
    <td>{{ $pengguna->id }}</td>
    <td>{{ $pengguna->name }}</td>
    <td>{{ $pengguna->peran_pengguna }}</td>
    <td>
        <a href="mailto:{{ $pengguna->email }}" title="{{ __('Kirim E-Mail ke :email', ['email' => $pengguna->email]) }}">{{ $pengguna->email }}</a>
    </td>
    <td>
        <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">{{ __('Aksi') }}</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('sunting.pengguna', compact('pengguna')) }}">Sunting</a>
                <a class="dropdown-item" href="{{ route('hapus.pengguna', compact('pengguna')) }}" data-toggle="modal" data-target="#modal-penghapusan" @click="konfirmasiPenghapusan($event.target)">Hapus</a>
            </div>
        </div>
    </td>
</tr>
