@if ($kelas == null)
<h5>Tidak ada data</h5>
@else
<div class="table-responsive">
    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Mata Pelajaran</th>
                <th scope="col">Nilai Akhir Pengetahuan</th>
                <th scope="col">Nilai Akhir Keterampilan</th>
                <th scope="col">Nilai Akhir</th>
                <th scope="col">Predikat</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
        <tr>
            <th>{{ $d->idmatapelajaran }}</th>
            <td>{{ $d->nama_mp }}</td>
            @foreach ($da as $das)
                @if ($das->idmata_pelajaran == $d->idmatapelajaran)
                <td>{{ $das->nilai_pengetahuan }}</td>
                <td>{{ $das->nilai_keterampilan }}</td>
                <td>
                    @if ($das->predikat != null)
                    {{ $das->nilai_akhir }}
                    @endif
                </td>
                <td>
                    {{ $das->predikat }}
                </td>
                @endif
            @endforeach
        </tr>
        @endforeach
        </tbody>
    </table>

</div>

@endif
