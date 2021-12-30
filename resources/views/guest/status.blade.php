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
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">RH</span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>Rechard Add New Task</strong></div>
                            <span class="d-flex text-muted">20Min ago</span>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">SP</span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>Shipa Review Completed</strong></div>
                            <span class="d-flex text-muted">40Min ago</span>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">MR</span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>Mora Task To Completed</strong></div>
                            <span class="d-flex text-muted">1Hr ago</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-lavender-purple">FL</span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>Fila Add New Task</strong></div>
                            <span class="d-flex text-muted">1Day ago</span>
                        </div>
                    </div>
                </div>
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
