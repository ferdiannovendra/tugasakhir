@extends('layoutsadmin.adminsekolah')

@section('title')
Daftar Pengguna
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
                <h6 class="mb-0 fw-bold ">Daftar Pengguna</h6>
                <button type="button" onclick="tambah_siswa('{{ $data[0]->classlist_idclass }}')" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#tambahsiswa"><i class="icofont-plus-circle"></i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $d->id }}</th>
                            <td>{{ $d->nik }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->lname }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->gender }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary" onclick="getDetailSiswa('{{$d->id}}')" data-bs-toggle="modal" data-bs-target="#ubahmodal"><i class="icofont-search-1 text-success"></i></button>
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
<div class="modal fade" id="tambahsiswa" tabindex="-1" aria-labelledby="tambahsiswa" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalcontenttambahsiswa">
            <div class="modal-header">
                <h5 class="modal-title h4">Tambah Siswa</h5>
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

function tambah_siswa(id) {
    $.ajax({
            type: 'POST',
            url: '{{route("listsiswa_tambahkelas")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                $('#modalcontenttambahsiswa').html(data.msg)
            }
        });
    }

</script>

@endsection
