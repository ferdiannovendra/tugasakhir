<table class="table">
    <thead>
        <tr>
            <th>Kompetensi Dasar</th>
            <th>Penilaian</th>
            <th>Kelompok/Teknik Penilaian</th>
            <th>Bobot Teknik Penilaian</th>
            <th>Nama Penilaian</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
            <?php $count =1; ?>
            @foreach($d->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->get() as $p)
            <tr>
                @if($loop->iteration == 1)
                <td rowspan="{{$d->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->count()}}">{{$d->kode_kd}}. {{$d->kompetensi_dasar}}</td>
                @endif
                {{-- @if ($p->idmata_pelajaran == $mp && $p->idclass == $kelas) --}}

                <td style="text-align:center;">P.<?php echo $count; ?></td>
                <td style="text-align:center;">{{$p->teknik_penilaian}}</td>
                <td style="text-align:center;">{{$p->bobot}}</td>
                <td style="text-align:center;">{{$p->nama}}</td>
                <?php $count++; ?>
                {{-- @endif --}}

            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
