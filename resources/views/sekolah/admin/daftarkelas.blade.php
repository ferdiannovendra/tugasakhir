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
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Daftar Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Status</th>
                            <th scope="col">Wali Kelas</th>
                            <th scope="col">Wali Kelas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $d->idclass_list }}</th>
                            <td>{{ $d->name_class }}</td>
                            <td>{{ $d->status }}</td>
                            <td>{{ $d->wali_kelas }}</td>
                            <td>{{ $d->jurusan_idjurusan }}</td>
                            <td>{{ $d->semester_idsemester }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->updated_at }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editholiday"><i class="icofont-edit text-success"></i></button>
                                    <form action="{{ route('postHapusKelas') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="idclass" value="{{$d->idclass_list}}">
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
                <h6 class="mb-0 fw-bold ">Tambah Data Kelas</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('postTambahKelas') }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                        </div>

                        <div class="col-md-6">
                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                            <select name="wali_kelas" class="form-control" id="wali_kelas">
                                @if(isset($dataGuru))
                                    @foreach($dataGuru as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endforeach
                                @else
                                <option value="-" disabled>Tidak ada data Guru</option>
                                @endif

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="semester" class="form-label">Semester</label>
                            <select name="semester" class="form-control" id="semester">
                                @if(isset($dataSemester))
                                    @foreach($dataSemester as $semester)
                                    <option value="{{ $semester->idsemester }}">{{ $semester->nama_semester }}</option>
                                    @endforeach
                                @else
                                <option value="-" disabled>Tidak ada data semester</option>
                                @endif

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" class="form-control" id="jurusan">
                                @if(isset($dataJurusan))
                                    @foreach($dataJurusan as $jurusan)
                                    <option value="{{ $jurusan->idjurusan }}">{{ $jurusan->nama_jurusan }}</option>
                                    @endforeach
                                @else
                                <option value="-" disabled>Tidak ada data Jurusan</option>
                                @endif

                            </select>
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
