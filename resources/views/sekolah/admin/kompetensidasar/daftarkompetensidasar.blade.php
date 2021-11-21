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
                <h6 class="mb-0 fw-bold ">Daftar Kompetensi Dasar</h6>
                <a href="{{ route('tambahkd') }}"><button type="button" class="btn btn-primary">Tambah Kompetensi Dasar</button></a>
            </div>
            <div class="card-body">
                <h6 class="mb-0 fw-bold ">Pilih Mata Pelajaran :</h6>
                <br>
                <select name="mpselect" class="form-control" id="mpselect">
                    <option value="/sekolah/kompetensidasar/0">Semua MK</option>
                    @if(isset($dataMP))
                        @foreach($dataMP as $mp)
                        <?php
                        $selected="";
                        if ($mp->idmata_pelajaran == $id) {
                            $selected="selected";
                        }
                        ?>
                        <option value="/sekolah/kompetensidasar/{{ $mp->idmata_pelajaran }}" <?php echo $selected;?>>{{ $mp->nama_mp }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                    @endif
                </select>
                <br>
                <hr>
                <br>
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kompetensi</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Tingkat / Kls</th>
                            <th scope="col">Kompetensi Dasar</th>
                            <th scope="col">Ringkasan Deskripsi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $d->idkompetensi_dasar }}</th>
                            <td>{{ $d->jenis_kd }}</td>
                            <td>{{ $d->semester }}</td>
                            <td>{{ $d->kode_kd }}</td>
                            <td>{{ $d->tingkat_pendidikan }}</td>
                            <td>{{ $d->kompetensi_dasar }}</td>
                            <td>{{ $d->ringkasan_deskripsi }}</td>
                            <td>{{ $d->status }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" onclick="getDetail('{{ $d->idkompetensi_dasar }}')" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ubahmodal"><i class="icofont-edit text-success"></i></button>
                                    <button type="button" onclick="hapus_data('{{csrf_token()}}','{{ $d->idkompetensi_dasar }}')" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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
</div><!-- Row end  -->

<div class="modal fade" id="ubahmodal" tabindex="-1" aria-labelledby="ubahmodal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalcontent">
            <div class="modal-header">
                <h5 class="modal-title h4">Ubah Kompetensi Dasar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
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

</script>
<script>
$('#mpselect').on('change', function () {
    var url = $(this).val(); // get selected value
    window.location = url;
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
        var act = '/sekolah/postHapusKD';
        $.post(act, { _token: token, id:id },
        function (data) {
            swal(
            'Terhapus!',
            'Data pengguna telah terhapus.',
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
