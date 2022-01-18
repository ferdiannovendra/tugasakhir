<form action="{{route('kirimnilai_akhirrapor')}}" method="post">
    @csrf
    <input type="hidden" name="matapelajaran" value="{{$mp}}">
<table class="table" style="border:1px solid black">
    <thead>
        <tr style="border:1px solid black">
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">No</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">Nama Siswa</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" colspan="2">Nilai Akhir</th>
            <th style="text-align:center;border:1px solid black; background-color:#50f041;" rowspan="3">Nilai Rapor</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">SKM</th>
            <th style="text-align:center;border:1px solid black; background-color:#50f041;" rowspan="3">Predikat</th>
        </tr>

        <tr>
            <td style="text-align:center;border:1px solid black; background-color:#6CD98A;" colspan="1">Pengetahuan</td>
            <td style="text-align:center;border:1px solid black; background-color:#6CD98A;" colspan="1">Keterampilan</td>
        </tr>

    </thead>
    <tbody>
        <?php $count=0; ?>
        @foreach ($nilai_siswa as $d)
            <tr>
                <td style="text-align:center;border:1px solid black">{{$loop->iteration}}</td>
                <td style="text-align:center;border:1px solid black">
                    {{$d[0]->name}} {{$d[0]->lname}}
                    <input type="hidden" name="idsiswa[]" value="{{{$d[0]->id}}}">
                </td>
                <td style="text-align:center;border:1px solid black">{{$d[0]->nilai_pengetahuan}}</td>
                <td style="text-align:center;border:1px solid black">{{$d[0]->nilai_keterampilan}}</td>

                {{-- Nilai Akhir Rapor udah kena hitung bobot --}}
                <td style="text-align:center;border:1px solid black">
                    <?php
                    if ($cek != null) {
                        $bobotP = $cek->pivot->bobot_pengetahuan;
                    $bobotK = $cek->pivot->bobot_keterampilan;

                    $hasil = round(($d[0]->nilai_pengetahuan * ($bobotP/100)) + ($d[0]->nilai_keterampilan * ($bobotK/100)));
                    echo $hasil;
                    }
                    $hasil = 0;
                    ?>
                    <input type="hidden" name="nilai_akhir[]" value="{{$hasil}}">
                </td>

                {{-- SKM --}}
                <td style="text-align:center;border:1px solid black">
                    {{$matapelajaran->skm}}
                </td>

                {{-- Hitung Predikat --}}
                <td style="text-align:center;border:1px solid black">
                    <?php
                    $skm = $matapelajaran->skm;
                    $interval = round(((100-$skm)/3));

                    $minA = 100 - $interval; //92
                    $minB = $minA - $interval; //84
                    $minC = $minB - $interval; //76
                    $predikat ="";

                    if ($hasil > $minA) {
                        $predikat = "A";
                    }else if($hasil <= $minA && $hasil >= $minB){
                        $predikat = "B";
                    }else if($hasil < $minB && $hasil >= $skm ){
                        $predikat = "C";
                    }else {
                        $predikat = "D";
                    }
                    echo $predikat;
                    ?>
                    <input type="hidden" name="predikat[]" value="{{$predikat}}">
                </td>

            </tr>
        <?php $count++; ?>
        @endforeach
    </tbody>
</table>
<button type="submit" class="btn btn-primary" >Kirim</button>

</form>
