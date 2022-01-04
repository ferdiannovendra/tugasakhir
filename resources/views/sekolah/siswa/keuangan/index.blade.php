@extends('layoutsadmin.adminsekolah')

@section('title')
Daftar Tagihan
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
                <h6 class="mb-0 fw-bold ">Daftar Tagihan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($data as $d)
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">
                                <h5>{{$d->idrekap_keuangan}}</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$d->nama_jenis}}</h5>
                                @if($d->status_bayar == 'unpaid' && $d->bukti_bayar == null)
                                <span class="badge rounded-pill bg-danger">Belum Lunas</span>
                                <br>
                                <hr>
                                <button data-bs-toggle="modal" data-bs-target="#ubahmodal{{ $d->idrekap_keuangan }}" class="btn btn-sm btn-white">Bayar</button>
                                <div class="modal fade" id="ubahmodal{{ $d->idrekap_keuangan }}" tabindex="-1" aria-labelledby="ubahmodal{{ $d->idrekap_keuangan }}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="modalcontent">
                                            <div class="modal-header">
                                                <h5 class="modal-title h4" style="color:black">Proses Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('uploadbukti')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="idrekap" value="{{ $d->idrekap_keuangan }}">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                            <label for="upload_bukti" class="form-label" style="color:black">Upload Bukti Bayar</label>
                                                            <input type="file" class="form-control" name="upload_bukti" accept=".jpg,.png,jpeg" required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <input type="submit" value="Submit" name="submit" class="form-control">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @elseif($d->status_bayar == 'paid')
                                <span class="badge rounded-pill bg-success">Lunas</span>
                                @elseif($d->status_bayar == 'dipensasi')
                                <span class="badge rounded-pill bg-info">Dispensasi</span>
                                @else
                                <span class="badge rounded-pill bg-secondary">Pembayaran Diproses</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
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
