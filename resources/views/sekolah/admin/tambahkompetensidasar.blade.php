@extends('layoutsadmin.adminsekolah')

@section('title')
Tambah Kelas
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
                <h6 class="mb-0 fw-bold ">Tambah Data Kompetensi Dasar</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('postTambahKD') }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" required>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="matapelajaran" class="form-label">Mata Pelajaran</label>
                            <select name="matapelajaran" class="form-control" id="matapelajaran">
                                @if(isset($dataMP))
                                    @foreach($dataMP as $mp)
                                    <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                                    @endforeach
                                @else
                                <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
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
