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
                        <h6 class="mb-0 fw-bold ">Daftar Sekolah</h6>
                        <a href="{{ route('tambahdatasekolah') }}">
                            <button type="button" class="btn btn-primary">+ Sekolah</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Domain</th>
                                    <th scope="col">Database</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{ $d->id }}</th>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->domain }}</td>
                                    <td>{{ $d->database }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td>{{ $d->updated_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('detailsekolah',$d->id) }}"><button type="button" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></button></a>
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
@endsection
