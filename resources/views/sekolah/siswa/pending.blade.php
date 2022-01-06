@extends('layoutsadmin.adminsekolah')

@section('title')
Oops - Maaf
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
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body text-center p-5">
                <img src="{{ asset('assets/images/no-data.svg') }}" class="img-fluid mx-size" alt="No Data">
                <div class="mt-4 mb-2">
                    <span class="">Tidak Ada Semester Aktif</span>
                </div>
                {{-- <button type="button" class="btn btn-white border lift mt-1">Get Started</button>
                <button type="button" class="btn btn-primary border lift mt-1">Back to Home</button> --}}
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
function getDetail(id) {
    $('#modalcontent').html(`
    <div class="modal-header">
        <h5 class="modal-title h4">Ubah Mata Pelajaran</h5>
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
            url: '{{route("ubahMP")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                $('#modalcontent').html(data.msg)
            }
        });
    }
</script>
@endsection
