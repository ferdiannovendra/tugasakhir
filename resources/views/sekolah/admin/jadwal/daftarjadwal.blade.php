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
                <h6 class="mb-0 fw-bold ">Daftar Jadwal Kelas</h6>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahModal">Tambah Jadwal Kelas</button>
            </div>
            <div class="card-body">
                <h6 class="mb-0 fw-bold ">Pilih Mata Pelajaran :</h6>
                <br>
                <select name="mpselect" class="form-control" id="mpselect">
                    <option value="/sekolah/presensi/0">Semua MK</option>
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
                        <option value="/sekolah/presensi/{{ $mp->idmata_pelajaran }}" <?php echo $selected;?>>{{ $mp->nama_mp }}</option>
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
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Akhir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>{{ $d->name_class }}</td>
                            <td>{{ $d->nama_mp }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->jam_mulai }}</td>
                            <td>{{ $d->jam_akhir }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" onclick="getDetail('{{ $d->idclass_list }}','{{$d->idmatapelajaran}}','{{$d->hari_id}}' )" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ubahmodal"><i class="icofont-edit text-success"></i></button>
                                    <button type="button" onclick="hapus_data('{{csrf_token()}}','{{ $d->idclass_list }}')" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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


<div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" >Tambah Presensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('postTambahJadwal') }}" method="post">
            <div class="modal-body">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <label for="nama_mp" class="form-label">Nama Mata Pelajaran</label>
                        <select name="matapelajaran" class="form-select" id="matapelajaran" required>
                            @if(isset($dataMP))
                                @foreach($dataMP as $mp)
                                <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                                @endforeach
                            @else
                            <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" id="kelas" required>
                            @if(isset($kelas))
                                @foreach($kelas as $k)
                                <option value="{{ $k->idclass_list }}">{{ $k->name_class }}</option>
                                @endforeach
                            @else
                            <option value="-" disabled>Tidak ada data Kelas</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="hari" class="form-label">Nama Hari</label>
                        <select name="hari" class="form-select" id="hari" required>
                            @if(isset($hari))
                                @foreach($hari as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            @else
                            <option value="-" disabled>Tidak ada data Hari</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required>
                    </div>
                    <div class="col-md-4">
                        <label for="jam_akhir" class="form-label">Jam Akhir</label>
                        <input type="time" class="form-control" name="jam_akhir" id="jam_akhir" required>
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

   $('#mpselect').on('change', function () {
    var url = $(this).val(); // get selected value
    window.location = url;
});
</script>

<script>
    function getDetail(id,idmp,idhari) {
    $.ajax({
            type: 'POST',
            url: '{{route("ubahjadwal")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
                'idmp': idmp,
                'idhari': idhari
            },
            success: function(data) {
                $('#modalcontent').html(data.msg)
            }
        });
    }
</script>
@endsection
