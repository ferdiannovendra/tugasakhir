@extends('layoutsadmin.adminsekolah')

@section('title')
Daftar Kelas
@endsection

@section('style')
<!-- plugin css file  -->
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
@endsection

@section('isi-content')
<div class="row align-item-center">
    <div class="col-md-12">
        @if (session('status'))
        <div role="alert" class="alert alert-success">{{session('status')}}</div>
        @elseif (session('error'))
        <div role="alert" class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Daftar Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <p style="text-transform: uppercase;">Semester : <b>{{$cekSemester->nama_semester}} - {{$cekSemester->tahun_ajaran}}</b></p>
                <hr>


                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Mata Pelajaran</th>
                            <th scope="col">Nilai Akhir Pengetahuan</th>
                            <th scope="col">Nilai Akhir Keterampilan</th>
                            <th scope="col">Nilai Akhir</th>
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

                            @else

                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- Row end  -->

@endsection
@section('script')
<!-- Plugin Js-->
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>

<!-- Jquery Page Js -->
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/page/hr.js') }}"></script>
<script>
    $(document).ready(function() {
       $('#patient-table')
       .addClass( 'nowrap' )

   });

</script>
@endsection
