@extends('layoutsadmin.adminsekolah')

@section('title')
Rekap Presensi
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
        <br>
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Rekap Presensi </h6>
            </div>
            <div class="card-body">
                <p style="text-transform: uppercase;">Mata Pelajaran : <b>{{$mapel->nama_mp}}</b></p>
                <p style="text-transform: uppercase;">Semester : <b>{{$cekSemester->nama_semester}} - {{$cekSemester->tahun_ajaran}}</b></p>
                <hr>
                <div class="row">
                    <div class="table-responsive">
                        <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Materi</th>
                                <th scope="col">Waktu Buka</th>
                                <th scope="col">Waktu Tutup</th>
                                <th scope="col">Status Presensi</th>
                                <th scope="col">Waktu Presensi</th>
                                <th scope="col">Alasan Ijin</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($presensi as $d)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $d->materi }}</td>
                                <td>{{ $d->start_time }}</td>
                                <td>{{ $d->end_time }}</td>
                                <td>
                                    @if($d->status_presensi == 1)
                                    <span class="badge rounded-pill bg-success"><i class="icofont-check-circled text-white"></i></span>
                                    @elseif($d->status_presensi == 0)
                                    <span class="badge rounded-pill bg-danger"><i class="icofont-error text-white"></i></span>
                                    @else
                                    <span class="badge rounded-pill bg-warning"><i class="icofont-ui-timer text-white"></i></span>
                                    @endif
                                </td>
                                <td>{{ $d->time_presensi }}</td>
                                <td>{{ $d->alasan_ijin }}</td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><!-- Row end  -->

<div class="modal fade" id="ubahmodal" tabindex="-1" aria-labelledby="ubahmodal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalcontent">
            <div class="modal-header">
                <h5 class="modal-title h4">Ubah Mata Pelajaran</h5>
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

   });

</script>

@endsection
