@extends('layoutsadmin.adminsekolah')

@section('title')
Lihat Rencana Nilai Keterampilan
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
                <h6 class="mb-0 fw-bold ">Lihat Hasil Pengolahan Nilai Keterampilan</h6>
            </div>
            <div class="card-body">
                <h6 class="mb-0 fw-bold ">Pilih Mata Pelajaran :</h6>
                <br>
                <select name="mpselect" class="form-control" id="matapelajaran2">
                    <option value="-">=== Pilih Mata Pelajaran ===</option>
                    @if(isset($dataMP))
                        @foreach($dataMP as $mp)
                        <?php
                        $selected="";
                        if (isset($id)) {
                            if ($mp->idmata_pelajaran == $id) {
                                $selected="selected";
                            }
                        }
                        ?>
                        <option value="{{ $mp->idmata_pelajaran }}" <?php echo $selected;?>>{{ $mp->nama_mp }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                    @endif
                </select>
                <br>
                <h6 class="mb-0 fw-bold ">Pilih Kelas :</h6>
                <br>
                <select name="kelas" class="form-select" id="class_select2" required>
                    <option value="-" selected disabled>Silahkan pilih mata pelajaran</option>
                </select>
                <br>
                <button type="button" id="btnLihatRincian" class="btn btn-primary" >Lihat Rincian Nilai Siswa</button>
                <button type="button" id="btnLihatRapor" class="btn btn-primary" >Lihat Nilai Rapor</button>

                <br>
                <hr>
                <br>
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

$('#mpselect').on('change', function(e) {
        var id_mp = e.target.value;
        alert(id_mp);
        $.ajax({
            type: "POST",
            url: "{{ route('listkelasadmin') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id_mp': id_mp
            },
            success: function(data) {
                $('.class_select').empty();
                $('.class_select').append('<option value="">--Pilih Kelas--</option>');
                for (let i = 0; i < data.listkelas.length; i++) {
                    $('.class_select').append('<option value="'+data.listkelas[i].idclass+'">'+data.listkelas[i].name_class+'</option>');
                }

            }
        })
    });
$('#matapelajaran2').on('change', function(e) {
        var id_mp = e.target.value;
        alert(id_mp);
        $.ajax({
            type: "POST",
            url: "{{ route('listkelasadmin') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id_mp': id_mp
            },
            success: function(data) {
                $('#class_select2').empty();
                $('#class_select2').append('<option value="">--Pilih Kelas--</option>');
                for (let i = 0; i < data.listkelas.length; i++) {
                    $('#class_select2').append('<option value="'+data.listkelas[i].idclass+'">'+data.listkelas[i].name_class+'</option>');
                }

            }
        })
    });

$('#btnLihatRincian').on('click', function(e) {
        var id_mp = $('#matapelajaran2').val();
        var id_class = $('#class_select2').val();
        $.ajax({
            type: "POST",
            url: "{{ route('lihat_rincian_keterampilan') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idmp': id_mp,
                'idclass': id_class
            },
            success: function(data) {
                $('#tabeldata').html(data.msg);
            }
        })
    });
$('#btnLihatRapor').on('click', function(e) {
        var id_mp = $('#matapelajaran2').val();
        var id_class = $('#class_select2').val();
        $.ajax({
            type: "POST",
            url: "{{ route('detail_rencana') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idmp': id_mp,
                'idclass': id_class
            },
            success: function(data) {
                $('#tabeldata').html(data.msg);
            }
        })
    });
</script>
@endsection
