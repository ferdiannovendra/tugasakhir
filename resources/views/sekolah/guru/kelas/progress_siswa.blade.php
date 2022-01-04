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
                <h6 class="mb-0 fw-bold ">Daftar Kelas</h6>
            </div>
            <div class="card-body">
                <h6>ID : {{$id}}</h6>
                <h6>Nama Lengkap : {{$data->name}} {{$data->lname}}</h6>
                <hr>
                <label for="data" class="form-label">Pilih data yang akan ditampilkan</label>
                <select name="data" id="data" class="form-select">
                    <option value="nilai">Penilaian</option>
                    <option value="keuangan">Keuangan</option>
                </select>
                <label for="data" class="form-label">Pilih Semester</label>
                <select name="semester" id="semester" class="form-select">
                    @foreach ($semester as $s)
                    <option value="{{ $s->idsemester }}">{{ $s->nama_semester}} - {{ $s->tahun_ajaran }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="idsiswa" value="{{ $id }}">
                <br>
                <button class="btn btn-primary" id="btnLihatRincian">Lihat</button>
                <hr>
                <div id="tabeldata">

                </div>
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

   $('#btnLihatRincian').on('click', function(e) {
        var idsiswa = {{$id}};
        var semester = $('#semester').val();
        var data = $('#data').val();
        $.ajax({
            type: "POST",
            url: "{{ route('postLihatData') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idsiswa': idsiswa,
                'data': data,
                'semester': semester
            },
            success: function(data) {
                $('#tabeldata').html(data.msg);
            }
        })
    });
</script>
@endsection
