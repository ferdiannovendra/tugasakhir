@extends('layoutsadmin.superadmin')

@section('title')
Super-Admin
@endsection

@section('style')
<!-- plugin css file  -->
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
@endsection

@section('isi-content')
<div class="row clearfix g-3">
    <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold ">Daftar Pengajuan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">NPSN</th>
                                    <th scope="col">Status</th>

                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{ $d->id }}</th>
                                    <td>{{ $d->nama_sekolah }}</td>
                                    <td>{{ $d->npsn }}</td>
                                    <td>
                                        @if ($d->status == 0)
                                        <span class="badge rounded-pill bg-warning">Menunggu</span>
                                        @elseif($d->status == 1)
                                        <span class="badge rounded-pill bg-primary">Pengajuan Diterima</span>
                                        @elseif($d->status == 2)
                                        <span class="badge rounded-pill bg-success">Selesai</span>
                                        @elseif($d->status == 3)
                                        <span class="badge rounded-pill bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($d->status == 0)
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" onclick="ubahstatus_terima({{$d->id}})" class="btn btn-outline-success"><i class="icofont-check text-success"></i></button>
                                            <button type="button" onclick="ubahstatus_tolak({{$d->id}})" class="btn btn-outline-danger"><i class="icofont-error text-danger"></i></button>
                                        </div>
                                        @elseif($d->status == 1)
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" onclick="ubahstatus_selesai({{$d->id}})" class="btn btn-outline-success"><i class="icofont-check text-success"></i></button>
                                            <button type="button" onclick="ubahstatus_tolak({{$d->id}})" class="btn btn-outline-danger"><i class="icofont-error text-danger"></i></button>
                                        </div>
                                        @elseif($d->status == 2)
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12">
        <div class="row g-3 row-deck">
            <div class="col-md-6 col-lg-6 col-xl-12">
                <div class="card bg-primary">
                    <div class="card-body row">
                        <div class="col">
                            <span class="avatar lg bg-white rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-file-text fs-5"></i></span>
                            <h1 class="mt-3 mb-0 fw-bold text-white">{{ $count }}</h1>
                            <span class="text-white">Sekolah Terdaftar</span>
                        </div>
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('assets/images/interview.svg') }}" alt="interview">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Row End -->
@endsection

@section('script')
<!-- Plugin Js-->
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>

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
    function ubahstatus_selesai(id)
    {
        swal({
            title: "Yakin Menyelesaikan Pengajuan?",
            text: "Status Pengajuan akan diubah",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF5722",
            confirmButtonText: "Ya, Selesaikan!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }).then(function () {
            var act = '/super-admin/ubahstatus_selesai';
            $.post(act, { _token: '<?php echo csrf_token() ?>', id:id },
            function (data) {
                swal(
                'Berhasil!',
                'Data telah diubah.',
                'success'
                ).then(function () {
                    location.reload();
                })
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Batal',
                    'Langkah pengajuan terhenti dan dibatalkan :)',
                    'error'
                    )
            }
        });
    }
    function ubahstatus_terima(id)
    {
        swal({
            title: "Yakin Menerima Pengajuan?",
            text: "Status Pengajuan akan diubah",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF5722",
            confirmButtonText: "Ya, Terima!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }).then(function () {
            var act = '/super-admin/ubahstatus_diterima';
            $.post(act, { _token: '<?php echo csrf_token() ?>', id:id },
            function (data) {
                swal(
                'Berhasil!',
                'Data telah diubah.',
                'success'
                ).then(function () {
                    location.reload();
                })
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Batal',
                    'Langkah pengajuan terhenti dan dibatalkan :)',
                    'error'
                    )
            }
        });
    }
    function ubahstatus_tolak(id)
    {
        swal({
            title: "Yakin Menolak Pengajuan?",
            text: "Status Pengajuan akan diubah",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF5722",
            confirmButtonText: "Ya, Tolak!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }).then(function () {
            var act = '/super-admin/ubahstatus_tolak';
            $.post(act, { _token: '<?php echo csrf_token() ?>', id:id },
            function (data) {
                swal(
                'Berhasil!',
                'Data telah diubah.',
                'success'
                ).then(function () {
                    location.reload();
                })
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Batal',
                    'Langkah pengajuan terhenti dan dibatalkan :)',
                    'error'
                    )
            }
        });
    }
</script>
@endsection
