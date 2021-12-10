<table class="table" style="border:1px solid black">
    <thead>
        <tr style="border:1px solid black">
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">No</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">Nama Siswa</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" colspan="{{$counter}}">Nilai Pengetahuan</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">Nilai Rapor</th>
        </tr>
        <tr>
            @foreach($data as $d)
            <td style="text-align:center;border:1px solid black; background-color:#6CD98A;" colspan="{{$d->penilaian()->count()}}">{{$d->kode_kd}}</td>
            @endforeach
        </tr>
        <tr>
            @foreach ($data as $d)
                @foreach ($d->penilaian()->get() as $p)
                    <td style="text-align:center;border:1px solid black;background-color:#f0be84;">{{$p->nama}} <br><b>({{$p->bobot}})</b></td>
                @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        <?php $hph =0;?>
        <?php $totalBobot =0;?>
        <?php $totalBobotUjian =0;?>
        <?php $totalNilai =0;?>
        <?php $totalNilaiUjian =0;?>
        @foreach ($nilai_siswa as $ns)
            <tr>
                <td style="text-align:center;border:1px solid black">{{$loop->iteration}}</td>
                <td style="text-align:center;border:1px solid black">{{$ns[0]->name}} {{$ns[0]->lname}}</td>
                <?php $color=""?>
                @for ($i = 0; $i < count($ns[1]); $i++)
                    @if ($ns[1][$i]->nilai == 0)
                        <?php $color="#F07E63";?>
                    @endif
                    {{-- Buat Perhitungan Nilai HPH --}}
                    @if ($i < count($ns[1])-2)
                    <?php
                        $totalNilai += $ns[1][$i]->nilai * $ns[1][$i]->bobot;
                        $totalBobot += $ns[1][$i]->bobot;
                    ?>
                    @else
                    <?php
                        $totalNilaiUjian += $ns[1][$i]->nilai * $ns[1][$i]->bobot;
                        $totalBobotUjian += $ns[1][$i]->bobot;
                    ?>
                    @endif
                    <td style="text-align:center;border:1px solid black;background-color:{{$color}};">{{$ns[1][$i]->nilai}}</td>
                    <?php $color=""?>
                @endfor
                <td style="text-align:center;border:1px solid black;background-color:rgb(167, 255, 109)">
                    <?php
                        $hph = $totalNilai / $totalBobot;
                        $nilai_rapor = (($hph * $totalBobot) + $totalNilaiUjian) / ($totalBobot + $totalBobotUjian);
                        echo $nilai_rapor;
                    ?>
                    <?php $hph =0;?>
                    <?php $totalBobot =0;?>
                    <?php $totalNilai =0;?>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
