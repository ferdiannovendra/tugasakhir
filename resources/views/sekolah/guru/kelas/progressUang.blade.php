<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Jenis</th>
        <th scope="col">Status</th>
        <th scope="col">Tanggal Lunas</th>
        <th scope="col">Bukti Pembayaran</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $d->nama_jenis }}</td>
        <td>
            @if($d->status_bayar == 'unpaid')
            <span class="badge rounded-pill bg-danger">Belum Lunas</span>
            @elseif($d->status_bayar == 'paid')
            <span class="badge rounded-pill bg-success">Lunas</span>
            @else
            <span class="badge rounded-pill bg-info">Dispensasi</span>
            @endif
        </td>
        <td>{{ $d->tanggal_pelunasan }}</td>
        <td>
            @if ($d->bukti_bayar != null)
            <a href="{{asset('fileupload/buktibayar/'.$d->bukti_bayar)}}" target="_blank" class="btn btn-secondary">Download</a>
            @else
            Tidak Ada
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
