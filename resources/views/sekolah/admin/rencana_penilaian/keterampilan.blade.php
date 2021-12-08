@extends('layoutsadmin.adminsekolah')

@section('title')
Perencanaan Nilai Pengetahuan
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
                <h6 class="mb-0 fw-bold ">Perencanaan Penilaian Pengetahuan</h6>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahModal">Duplikat Penilaian</button>
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
                <h6 class="mb-0 fw-bold ">Jumlah Penilaian :</h6>
                <br>
                <select name="jumlah" class="form-select" id="jumlah" required>
                    <option value="1" selected>1</option>
                    <option value="2" >2</option>
                    <option value="3" >3</option>
                    <option value="4" >4</option>
                    <option value="5" >5</option>
                    <option value="6" >6</option>
                    <option value="7" >7</option>
                    <option value="8" >8</option>
                    <option value="9" >9</option>
                    <option value="10" >10</option>
                </select>
                <button type="button" id="btntambah" class="btn btn-primary" >Tambah</button>

                <br>
                <hr>
                <br>
                <form method="post" action="{{ route('kirim_rencana_keterampilan') }}" id="formkirim">
                    @csrf
                <input type="hidden" name="jumlah" id="jumlahkirim">
                <input type="hidden" name="matapelajaran" id="matapelajarankirim">
                <input type="hidden" name="kelas" id="kelaskirim">
                <table class="table table-hover align-middle mb-0" style="width:100%" id="table">
                </table>
                </form>
            </div>
        </div>
    </div>
</div><!-- Row end  -->
<div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" >Duplikat Rencana Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('duplikatrencananilai') }}" method="post">
            <div class="modal-body">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <label for="nama_mp" class="form-label">Nama Mata Pelajaran</label>
                        <select name="matapelajaran" class="form-select" id="mpselect" required>
                            <option value="-" selected disabled>Pilih mata pelajaran</option>
                            @if(isset($dataMP))
                                @foreach($dataMP as $mp)
                                <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                                @endforeach
                            @else
                            <option value="-" disabled>Tidak ada data Guru</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="kelas" class="form-label">Kelas Awal</label>
                        <select name="kelas_awal" class="form-select class_select" required>
                            <option value="-" selected disabled>Silahkan pilih mata pelajaran</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="kelas" class="form-label">Kelas Tujuan</label>
                        <select name="kelas_tujuan" class="form-select class_select" required>
                            <option value="-" selected disabled>Silahkan pilih mata pelajaran</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
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

$('#btntambah').on('click', function(e) {
        var jumlah = parseInt($('#jumlah').val());
        var id_mp = $('#matapelajaran2').val();
        var id_class = $('#class_select2').val();

        $('#jumlahkirim').val(jumlah);
        $('#matapelajarankirim').val(id_mp);
        $('#kelaskirim').val(id_class);
        $.ajax({
            type: "POST",
            url: "{{ route('generate_rencana_keterampilan') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idmp': id_mp,
                'jumlah': jumlah,
                'idclass': id_class
            },
            success: function(data) {
                $('#table').empty();
                console.log(data);
                $('#table').append('<thead>' +
                        '<tr>');
                for (let i = 0; i <= jumlah; i++) {
                    if (i==0) {
                        $('#table').append('<th>Penilaian</th>');
                    }else{
                        $('#table').append('<th>PH.'+i+'</th>');
                    }
                }
                $('#table').append('<thead>' +
                        '<tr>');
                for (let i = 0; i <= jumlah; i++) {
                    if (i==0) {
                        $('#table').append('<th>Kelompok/Teknik Penilaian</th>');
                    }else{
                        $('#table').append('<th><select class="form-select" name="teknik_'+i+'">'+
                        '<option value="Kinerja">Kinerja</option>' +
                        '<option value="Projek">Projek</option>' +
                        '<option value="Fortopolio">Fortopolio</option>' +
                        '<option value="Teknik 1">Teknik 1</option>' +
                        '<option value="Teknik 2">Teknik 2</option>' +
                        '<option value="Teknik 3">Teknik 3</option>' +
                        '</select></th>');
                    }
                }
                $('#table').append('<thead>' +
                        '<tr>');

                for (let i = 0; i <= jumlah; i++) {
                    if (i==0) {
                        $('#table').append('<th>Nama Penilaian</th>');
                    }else{
                        $('#table').append('<th><input class="form-control" type="text" name="nama_p'+i+'"></th>');
                    }
                }
                $('#table').append('<thead>' +
                        '<tr>');

                for (let i = 0; i <= jumlah; i++) {
                    if (i==0) {
                        $('#table').append('<th>Bobot Penilaian</th>');
                    }else{
                        $('#table').append('<th><input class="form-control" type="text" name="bobot_p'+i+'"></th>');
                    }
                }
                $('#table').append('<tbody>');
                // $('#table > tbody').append('<tr>...</tr><tr>...</tr>');

                for (let i = 0; i < data.kd.length; i++) {
                    $('#table > tbody').append('<tr>' +
                        '<td>'+data.kd[i].kode_kd+'. '+ data.kd[i].kompetensi_dasar+'</th>' +
                        '</tr>');
                        for (let j = 1; j <= jumlah; j++) {
                            $('#table tr:last').append('<td><input name="p'+j+'[]" value="'+data.kd[i].idkompetensi_dasar+'" type="checkbox"></td>');
                        }
                    }

                    $('#table').append('<button type="submit" id="btntambah" class="btn btn-primary" >Simpan</button>');
                }
        })
    });
</script>

<script>
    function hapus_data(token, id) {
    swal({
        title: "Yakin Ingin Menghapus Data?",
        text: "Jika dihapus data akan Sepenuhnya Hilang",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF5722",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
    }).then(function () {
        var act = '/sekolah/postAdminHapusPresensi';
        $.post(act, { _token: token, id:id },
        function (data) {
            swal(
            'Terhapus!',
            'Data Presensi telah terhapus.',
            'success'
            ).then(function () {
                location.reload();
            })
        });

    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal(
                'Batal',
                'Langkah menghapus terhenti dan dibatalkan :)',
                'error'
                )
        }
    })

}

function getDetail(id) {
    $.ajax({
            type: 'POST',
            url: '{{route("ubahkd")}}',
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
