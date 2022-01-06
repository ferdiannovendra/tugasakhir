@extends('layoutsadmin.adminsekolah')

@section('title')
Naik Kelas
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
                <h6 class="mb-0 fw-bold ">Naik Kelas</h6>

            </div>
            <div class="card-body">
                <form action="{{ route('postUpdateKelas') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <h6>Kelas awal</h6>
                            <select name="kelasawal" id="kelasawal" class="form-select">
                                <option value="-" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                <option value="{{ $k->idclass_list }}">{{ $k->name_class }}</option>
                                @endforeach
                            </select>
                            <br>
                            <hr>
                            <br>
                            <div id="data">

                            </div>

                        </div>
                        <div class="col-6">
                            <h6>Kelas tujuan</h6>
                            <select name="kelastujuan" id="" class="form-select">
                                @foreach ($kelas as $k)
                                <option value="{{ $k->idclass_list }}">{{ $k->name_class }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
<script>

$('#kelasawal').on('change', function(e) {
        var id = e.target.value;
        $.ajax({
            type: "POST",
            url: "{{ route('ceksiswa') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                $('#data').html(data.msg);

            }
        })
    });
</script>
@endsection
