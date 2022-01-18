<!DOCTYPE html>
<html>
<head>
	<title>Cetak Nilai Saya</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}

        .column {
        margin-left: 20px;
        float: left;
        width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
	</style>
@php
$kepsek = App\Models\MasterWeb::Kepsek();
@endphp

    <div class="row">
        <div class="column">
            <p>Nama Sekolah &emsp; : &emsp; {{app('currentTenant')->name}} <br>
                Alamat &emsp; : &emsp; {{app('currentTenant')->name}} <br>
                Nama Peserta Didik &emsp; : &emsp; {{ $user->name }} {{ $user->lname }} <br>
                Program Keahlian &emsp; : &emsp; {{$jurusan->nama_jurusan}} <br> </p>
        </div>
        <div class="column">
            <p>NISN &emsp; : &emsp; {{$detail->nisn}} <br>
                Kelas &emsp; : &emsp; {{$jurusan->nama_jurusan}} <br>
                Semester &emsp; : &emsp; {{$semester->nama_semester}} <br>
                Tahun Pelajaran &emsp; : &emsp; {{$semester->tahun_ajaran}}</p>
        </div>
    </div>



	<table class='table table-bordered'>
		<thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Mata Pelajaran</th>
                <th scope="col">Pengetahuan</th>
                <th scope="col">Keterampilan</th>
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
    <div class="row">
        <div class="column">
            <p  style="border-style: solid; border-width: 1px;padding:10px; width:100&;"><u>Data Kehadiran </u><br>
                Hadir &emsp; : &emsp; {{ $counthadir }} <br>
                Tidak Hadir &emsp; : &emsp; {{ $counttidakhadir }} <br>
                Ijin &emsp; : &emsp; {{ $countijin }} <br> </p>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="column">
        </div>
        <div class="column">
            <p>Kepala Sekolah<br></p>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="column">
        </div>
        <div class="column">
            <p>{{$kepsek->name}} {{$kepsek->lname}}<br></p>
        </div>
    </div>
</body>
</html>
