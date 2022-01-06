@extends('layoutsadmin.adminsekolah')

@section('title')
Input Nilai Pengetahuan
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
                <h6 class="mb-0 fw-bold ">Input Penilaian Keterampilan</h6>
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
                <h6 class="mb-0 fw-bold ">Penilaian :</h6>
                <br>
                <select name="penilaian" class="form-select" id="penilaian" required>
                    <option value="-" selected>Silahkan Pilih kelas dan mata pelajaran</option>
                </select>
                <button type="button" id="btntambah" class="btn btn-primary" >Tambah</button>

                <br>
                <hr>
                <br>
                <form method="post" action="{{ route('kirim_nilai') }}" id="formkirim">
                    @csrf
                <input type="hidden" name="matapelajaran" id="matapelajarankirim">
                <input type="hidden" name="kelas" id="kelaskirim">
                <input type="hidden" name="penilaian" id="penilaiankirim">
                <div id="tabeldata">

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
$('#class_select2').on('change', function(e) {
        var idclass = e.target.value;
        var idmp = $('#matapelajaran2').val();
        alert(idclass);
        $.ajax({
            type: "POST",
            url: "{{ route('listpenilaian_keterampilan') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idclass': idclass,
                'idmp' :idmp
            },
            success: function(data) {
                $('#penilaian').empty();
                $('#penilaian').append('<option value="">--Pilih Penilaian--</option>');
                for (let i = 0; i < data.listpenilaian.length; i++) {
                    $('#penilaian').append('<option value="'+data.listpenilaian[i].idpenilaian+'">'+data.listpenilaian[i].nama+'</option>');
                }

            }
        })
    });

$('#btntambah').on('click', function(e) {
        var penilaian = $('#penilaian').val();
        var id_mp = $('#matapelajaran2').val();
        var id_class = $('#class_select2').val();

        $('#matapelajarankirim').val(id_mp);
        $('#kelaskirim').val(id_class);
        $('#penilaiankirim').val(penilaian);
        $.ajax({
            type: "POST",
            url: "{{ route('generate_input_nilai') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idmp': id_mp,
                'idclass': id_class,
                'idpenilaian':penilaian
            },
            success: function(data) {
                $('#tabeldata').html(data.msg);
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
