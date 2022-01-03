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
	</style>
	<center>

		<h5>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
            @if(\Spatie\Multitenancy\Models\Tenant::checkCurrent())

        @php
        $masterweb = App\Models\MasterWeb::all();
        @endphp
        <img width="100px" height="100px" style="padding-bottom:100px;" class="img-fluid" src="{{ public_path('fileupload/'.$masterweb[0]->logo) }}" alt="">
        @else
        <img src="{{public_path('asset_front/img/hero/hero-img.png') }}" class="img-fluid" alt="" />

        @endif
		<h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5>
	</center>

	<table class='table table-bordered'>
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

</body>
</html>
