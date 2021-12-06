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
                <h6 class="mb-0 fw-bold ">Daftar Presensi</h6>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahModal">Tambah Presensi</button>
            </div>
            <div class="card-body">
                <h6 class="mb-0 fw-bold ">Pilih Mata Pelajaran :</h6>
                <br>
                <select name="matapelajaran" class="form-control" id="mpselect">
                    <option value="-">Silahkan pilih mata pelajaran</option>

                    @if(isset($mata_pelajaran))
                        @foreach($mata_pelajaran as $mp)
                        <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                    @endif
                </select>
                <br>
                <h6 class="mb-0 fw-bold ">Pilih Kelas :</h6>
                <br>
                <select name="kelas" class="form-control" id="class_select">
                    <option value="-" disabled>Pilih Mata Pelajaran Dahulu</option>
                </select>
                <br><br>
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Materi</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $count =1; ?>
                            @if(isset($data))
                            @foreach($data as $d)
                            <tr>
                                <th scope="row">{{ $d->idpresensi }}</th>
                                <td>{{ $d->idmatapelajaran }}</td>
                                <td>{{ $d->materi }}</td>
                                <td>{{ $d->start_time }}</td>
                                <td>{{ $d->end_time }}</td>
                                <td>{{ $d->catatan_pertemuan }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <a href="{{route('detailpresensiguru',$d->idpresensi)}}"><button type="button" class="btn btn-outline-secondary"><i class="icofont-info-circle text-seconadary"></i></button></a>
                                        <button type="button" onclick="getDetail('{{ $d->idpresensi }}')" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ubahmodal"><i class="icofont-edit text-success"></i></button>
                                        <button type="button" onclick="hapus_data('{{csrf_token()}}','{{ $d->idpresensi }}')" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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
                <h5 class="modal-title h4">Ubah Presensi</h5>
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

<div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" >Tambah Presensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('postTambahPresensi') }}" method="post">
            <div class="modal-body">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <label for="materi" class="form-label">Materi</label>
                        <input type="text" class="form-control" id="materi" name="materi" required>
                    </div>
                    <div class="col-md-12">
                        <label for="matapelajaran" class="form-label">Mata Pelajaran</label>
                        <select name="matapelajaran" class="form-select" id="matapelajaran2">
                            <option value="-" selected disabled>Silahkan pilih mata pelajaran</option>

                            @if(isset($mata_pelajaran))
                            @foreach($mata_pelajaran as $mp)
                            <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                            @endforeach
                            @else
                            <option value="-" disabled>Tidak ada Mata Pelajaran</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="matapelajaran" class="form-label">Kelas</label>
                        <select name="kelas" class="form-control" id="class_select2">
                            <option value="-" disabled>Pilih Mata Pelajaran Dahulu</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="start_time" class="form-label">Waktu Buka</label>
                        <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                    </div>
                    <div class="col-md-12">
                        <label for="end_time" class="form-label">Waktu Tutup</label>
                        <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                    </div>
                    <div class="col-md-12">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan"></textarea>
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

</script>
<script>
    $('#mpselect').on('change', function(e) {
        var id_mp = e.target.value;
        alert(id_mp);
        $.ajax({
            type: "POST",
            url: "{{ route('listkelas') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id_mp': id_mp
            },
            success: function(data) {
                console.log(data.listkelas);
                $('#class_select').empty();
                $('#class_select').append('<option value="">--Pilih Kelas--</option>');
                for (let i = 0; i < data.listkelas.length; i++) {
                    $('#class_select').append('<option value="'+data.listkelas[i].idclass_list+'">'+data.listkelas[i].name_class+'</option>');
                }

            }
        })
    });
    $('#matapelajaran2').on('change', function(e) {
        var id_mp = e.target.value;
        alert(id_mp);
        $.ajax({
            type: "POST",
            url: "{{ route('listkelas') }}",
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id_mp': id_mp
            },
            success: function(data) {
                console.log(data.listkelas);
                $('#class_select2').empty();
                $('#class_select2').append('<option value="">--Pilih Kelas--</option>');
                for (let i = 0; i < data.listkelas.length; i++) {
                    $('#class_select2').append('<option value="'+data.listkelas[i].idclass+'">'+data.listkelas[i].name_class+'</option>');
                }

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
        var act = '/sekolah/postHapusKelas';
        $.post(act, { _token: token, idclass:id },
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
    $('#modalcontent').html(`
    <div class="modal-header">
        <h5 class="modal-title h4">Ubah Presensi</h5>
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
            url: '{{route("ubahpresensi")}}',
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
