@extends('layoutsadmin.guest')

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
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold ">Progress Pengajuan</h6>
            </div>
            <div class="card-body">
                <h6>{{ $cek->nama_sekolah }}</h6>
                <small>{{ $cek->created_at }}</small>
                <br>
                <hr>
                <p>Status terkini :
                    @if ($cek->status == 0)
                    <span class="badge rounded-pill bg-warning">Menunggu</span>
                    @elseif($cek->status == 1)
                    <span class="badge rounded-pill bg-primary">Pengajuan Diterima</span>
                    @elseif($cek->status == 2)
                    <span class="badge rounded-pill bg-success">Selesai</span>
                        @if ($data != "")
                            <hr>
                            <h5>Data Sistem</h5>
                            <p>URL : <a href="http://{{ $data->domain }}" target="_blank" class="fw-bold text-secondary">{{ $data->domain }}</a></p>
                            <br>
                            <h5>Akses Admin</h5>
                            <p>Email : admin@admin.com</p>
                            <p>Password : adminsistem</p>
                            <small style="color: red"><b>Harap segera melakukan ubah password</b></small>
                        @endif
                    @elseif($cek->status == 3)
                    <span class="badge rounded-pill bg-danger">Ditolak</span>
                    @endif
                </p>
            </div>
        </div> <!-- .card: My Timeline -->
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
@endsection
