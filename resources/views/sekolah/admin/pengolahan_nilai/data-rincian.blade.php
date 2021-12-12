<table class="table" style="border:1px solid black">
    <thead>
        <tr style="border:1px solid black">
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">No</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">Nama Siswa</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" colspan="{{$counter}}">Nilai</th>
        </tr>

        <tr>
            @foreach($data as $d)
            <td style="text-align:center;border:1px solid black; background-color:#6CD98A;" colspan="{{$d->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->count()}}">{{$d->kode_kd}}</td>
            @endforeach
        </tr>
        <tr>
            @foreach ($data as $d)
                @foreach ($d->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->get() as $p)
                    <td style="text-align:center;border:1px solid black;background-color:#f0be84;">{{$p->nama}} <br><b>({{$p->bobot}})</b></td>
                @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($nilai_siswa as $ns)
            <tr>
                <td style="text-align:center;border:1px solid black">{{$loop->iteration}}</td>
                <td style="text-align:center;border:1px solid black">{{$ns[0]->name}} {{$ns[0]->lname}}</td>
                <?php $color=""?>
                @for ($i = 0; $i < count($ns[1]); $i++)
                    @if ($ns[1][$i]->nilai == 0)
                        <?php $color="#F07E63";?>
                    @endif
                    <td style="text-align:center;border:1px solid black;background-color:{{$color}};">{{$ns[1][$i]->nilai}}</td>
                    <?php $color=""?>

                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
