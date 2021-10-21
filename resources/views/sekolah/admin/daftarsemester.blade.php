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
                <h6 class="mb-0 fw-bold ">Daftar Semester</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Semester</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $d->idsemester }}</th>
                            <td>{{ $d->nama_semester }}</td>
                            <td>{{ $d->tahun_ajaran }}</td>
                            <td>{{ $d->start_date }}</td>
                            <td>{{ $d->end_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editholiday"><i class="icofont-edit text-success"></i></button>
                                    <form action="{{ route('postHapusSemester') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="idsemester" value="{{$d->idsemester}}">
                                        <button type="submit" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                    </form>
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

    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Tambah Data Semester</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('postTambahSemester') }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="nama_semester" class="form-label">Nama Semester</label>
                            <!-- <input type="text" class="form-control" id="nama_semester" name="nama_semester" required> -->
                            <select name="nama_semester" class="form-control" id="nama_semester">
                                <option value="ganjil">Ganjil</option>
                                <option value="ganjil">Genap</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" name="tahun_ajaran" placeholder="Contoh: 2021/2022" required>
                        </div>
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" placeholder="Contoh: 2021/2022" id="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" placeholder="Contoh: 2021/2022" id="end_date" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
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
       .dataTable( {
           responsive: true,
           columnDefs: [
               { targets: [-1, -3], className: 'dt-body-right' }
           ]
       });
   });

</script>
@endsection
