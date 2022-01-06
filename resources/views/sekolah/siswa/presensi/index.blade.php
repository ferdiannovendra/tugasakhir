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
        <br>
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Daftar Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <p style="text-transform: uppercase;">Semester : <b>{{$cekSemester->nama_semester}} - {{$cekSemester->tahun_ajaran}}</b></p>
                <hr>
                <div class="row">
                    @foreach($data as $d)
                    <div class="col-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">
                                    <h5>{{$d->idmatapelajaran}}</h5>
                                            @foreach($cekpresensi as $cek)
                                                    @if($cek->idmatapelajaran == $d->idmatapelajaran)
                                                    <button type="button" onclick="presensi('{{csrf_token()}}','{{ $cek->idpresensi }}')" class="btn btn-outline-success btn-block">Masuk</button>
                                                    @endif
                                            @endforeach

                                </div>
                                <a href="{{route('rekappresensi', $d->idmatapelajaran)}}">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: white">{{$d->nama_mp}}</h5>
                                </div>
                                </a>
                            </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div><!-- Row end  -->

<div class="modal fade" id="ubahmodal" tabindex="-1" aria-labelledby="ubahmodal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalcontent">
            <div class="modal-header">
                <h5 class="modal-title h4">Ubah Mata Pelajaran</h5>
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

   });

</script>
<script>
function getDetail(id) {
    $('#modalcontent').html(`
    <div class="modal-header">
        <h5 class="modal-title h4">Ubah Mata Pelajaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class='modal-body'>
        <div class='row justify-content-center'>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
</div>`)
    $.ajax({
            type: 'POST',
            url: '{{route("ubahMP")}}',
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
<script>
    function presensi(token, id) {
    swal({
        title: "Konfirmasi Lakukan Presensi?",
        // text: "Jika dihapus data akan Sepenuhnya Hilang",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF5722",
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
    }).then(function () {
        var act = '/sekolah/siswa/isipresensi';
        $.post(act, { _token: token, id:id },
        function (data) {
            swal(
            'Berhasil!',
            'Presensi Berhasil.',
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
</script>
@endsection
