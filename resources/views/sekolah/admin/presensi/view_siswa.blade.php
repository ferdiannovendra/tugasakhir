@extends('layoutsadmin.adminsekolah')

@section('title')
Daftar Siswa
@endsection

@section('style')
<!-- plugin css file  -->
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
@endsection

@section('isi-content')
<div class="row align-item-center">
    <div class="col-md-12">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary"><i class="icofont-rounded-left text-white"></i> Back</button></a>
    </div>
    <div class="col-md-12">
        @if (session('status'))
        <div role="alert" class="alert alert-success">{{session('status')}}</div>
        @elseif (session('error'))
        <div role="alert" class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
    <br>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Daftar Siswa</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <h5>
                        <span class="badge bg-primary">Jumlah Siswa : {{$countsiswa}}</span>
                        </h5>
                        <h5>
                        <span class="badge bg-success">Siswa Hadir : {{$countHadir}}</span>
                        </h5>
                        <h5>
                        <span class="badge bg-danger">Siswa Tidak Hadir : {{$countTidakHadir}}</span>
                        </h5>
                    </div>
                    <div class="col-6" style="text-align: end">
                        <h5>
                        <span class="badge bg-primary">{{$mp->nama_mp}}</span>
                        </h5>
                        <h5>
                        <span class="">{{$presensi->start_time}}</span>
                        </h5>
                        <h5>
                        <span class="">{{$presensi->materi}}</span>
                        </h5>
                    </div>
                </div>

                <br>
                <!-- <p><b>Siswa Hadir :</b></p>
                <p><b>Siswa Tidak Hadir &emsp;:</b></p> -->
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">NISN</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Status Presensi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $d->nisn }}</th>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->lname }}</td>
                            <td>{{ $d->time_presensi }}</td>
                            <td>
                                @if($d->status_presensi == 1)
                                <span class="badge rounded-pill bg-success"><i class="icofont-check-circled text-white"></i></span>
                                @else
                                <span class="badge rounded-pill bg-danger"><i class="icofont-error text-white"></i></span>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary" onclick="getDetailSiswa('{{$d->id}}')" data-bs-toggle="modal" data-bs-target="#ubahmodal"><i class="icofont-search-1 text-success"></i></button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="getDetailPresensi('{{$presensi->idpresensi}}','{{$d->id}}')" data-bs-toggle="modal" data-bs-target="#ubahstatus"><i class="icofont-edit text-success"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- Row end  -->

<div class="modal fade" id="ubahstatus" tabindex="-1" aria-labelledby="ubahstatus" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalcontent2">
            <div class="modal-header">
                <h5 class="modal-title h4">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahmodal" tabindex="-1" aria-labelledby="ubahmodal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalcontent">
            <div class="modal-header">
                <h5 class="modal-title h4">Detail Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
       .dataTable( {
           responsive: true,
           columnDefs: [
               { targets: [-1, -3], className: 'dt-body-right' }
           ]
       });
   });

</script>
<script>
    function getDetailSiswa(id) {
    $('#modalcontent').html(`
    <div class="modal-header">
        <h5 class="modal-title h4">Detail Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class='modal-body'>
        <div class='row justify-content-center'>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>`)
$.ajax({
        type: 'POST',
        url: '{{route("getdetailsiswa")}}',
        data: {
            '_token': '<?php echo csrf_token() ?>',
            'id': id
        },
        success: function(data) {
            $('#modalcontent').html(data.msg)
        }
    });
}

function getDetailPresensi(idpresensi, iduser) {
    $('#modalcontent2').html(`
    <div class="modal-header">
        <h5 class="modal-title h4">Ubah Status Presensi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class='modal-body'>
        <div class='row justify-content-center'>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
</div>`)
    $.ajax({
            type: 'POST',
            url: '{{route("ubahstatus_presensi")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idpresensi': idpresensi,
                'iduser': iduser
            },
            success: function(data) {
                $('#modalcontent2').html(data.msg)
            }
        });
    }

</script>

@endsection
