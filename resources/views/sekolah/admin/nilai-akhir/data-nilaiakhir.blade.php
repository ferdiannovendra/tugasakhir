<table class="table" style="border:1px solid black">
    <thead>
        <tr style="border:1px solid black">
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">No</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" rowspan="3">Nama Siswa</th>
            <th style="text-align:center;border:1px solid black; background-color:#F0DD41;" colspan="2">Nilai Akhir</th>
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
                <td style="text-align:center;border:1px solid black">{{$d[0]->name}} {{$d[0]->lname}}</td>
                <td style="text-align:center;border:1px solid black">{{$d[0]->nilai_pengetahuan}}</td>
                <td style="text-align:center;border:1px solid black">{{$d[0]->nilai_keterampilan}}</td>
            </tr>
        <?php $count++; ?>
        @endforeach
    </tbody>
</table>
