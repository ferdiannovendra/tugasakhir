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
                <h6 class="mb-0 fw-bold ">Rekap Tagihan Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{route('postBulkAction')}}" method="post">
                        @csrf
                        <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Lunas</th>
                                <th scope="col">Bukti Pembayaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $d->name }} {{ $d->lname }}</td>
                                <td>{{ $d->nama_jenis }}</td>
                                <td>
                                    @if($d->status_bayar == 'unpaid')
                                    <span class="badge rounded-pill bg-danger">Belum Lunas</span>
                                    @elseif($d->status_bayar == 'paid')
                                    <span class="badge rounded-pill bg-success">Lunas</span>
                                    @else
                                    <span class="badge rounded-pill bg-info">Dispensasi</span>
                                    @endif
                                </td>
                                <td>{{ $d->tanggal_pelunasan }}</td>
                                <td>
                                    @if ($d->bukti_bayar != null)
                                    <a href="{{asset('fileupload/buktibayar/'.$d->bukti_bayar)}}" target="_blank" class="btn btn-secondary">Download</a>
                                    @else
                                    Tidak Ada
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" name="idtagihan[]" id="" value="{{$d->idrekap_keuangan}}">
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <select name="action" id="" class="form-select">
                            <option value="paid">Lunas</option>
                            <option value="unpaid">Belum Lunas</option>
                            <option value="dispensasi">Dispensasi</option>
                        </select>
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </form>
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
        var act = '/sekolah/postHapusJenisPembayaran';
        $.post(act, { _token: token, idjenis:id },
        function (data) {
            swal(
            'Terhapus!',
            'Data Jenis Pembayaran telah terhapus.',
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
            url: '{{route("ubahJenisPembayaran")}}',
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
