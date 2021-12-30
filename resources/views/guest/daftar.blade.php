@extends('layoutsadmin.guest')

@section('title')
Daftar Sekolah
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
                <h6 class="mb-0 fw-bold ">Tambah Data Sekolah</h6>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Nomor Pokok Sekolah Nasional (NPSN)</label>
                            <input type="text" id='npsn' name="npsn" class="form-control" required>
                        </div>
                    </div>
                </div>

                <a class="btn btn-primary mt-4" id="btncek" onclick="getDetail()">Cek NPSN</a>
                <div id="data">

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

function getDetail() {
    var input = document.getElementById("npsn");
    input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("btncek").click();
    }
    });

    var npsn = document.getElementById("npsn").value;
    if (npsn == "") {
        alert("Harap isi NPSN dahulu");
    }else{
        $('#data').html(`<div class="row justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`)
        $.ajax({
                type: 'POST',
                url: '{{route("ceksekolah")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'npsn': npsn
                },
                success: function(data) {
                    $('#data').html(data.msg)
                }
            });
    }

    }
</script>
<script>

    function simpan() {
        var npsn = document.getElementById("npsn").value;
        var nama = document.getElementById("nama").innerHTML;
        swal({
            title: "Yakin Mendaftarkan Sekolah anda?",
            text: "Sekolah akan masuk pada proses pendaftaran",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF5722",
            confirmButtonText: "Ya, Ajukan!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }).then(function () {
            var act = '/guest/simpansekolah';
            $.post(act, { _token: '<?php echo csrf_token() ?>', npsn:npsn,nama:nama },
            function (data) {
                swal(
                'Berhasil!',
                'Data telah Diajukan.',
                'success'
                ).then(function () {
                    location.pathname = "/guest/proses-daftar";
                })
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Batal',
                    'Langkah pengajuan terhenti dan dibatalkan :)',
                    'error'
                    )
            }
        });

}
</script>
