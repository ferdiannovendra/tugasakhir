@extends('layoutsadmin.adminsekolah')

@section('title')
Daftar Pengguna
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
                <h6 class="mb-0 fw-bold ">Daftar Guru</h6>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahModal">+ Tambah Data (Import)</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telpon</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $d->id }}</th>
                            <td>{{ $d->nik }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->lname }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->address }}</td>
                            <td>{{ $d->phone }}</td>
                            <td>{{ $d->gender }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary" onclick="reset('{{csrf_token()}}','{{$d->id}}')"><i class="icofont-ui-settings text-success"></i></button>
                                    <form action="{{ route('postHapusUser') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="iduser" value="{{$d->id}}">
                                        <button type="submit" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                    </form>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" >Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('uploadguru') }}" enctype="multipart/form-data" method="post">
            <div class="modal-body">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <p>Upload file data yang akan dimasukkan ke database. Harap menggunakan format yang telah disediakan. <a href="{{asset('Format Guru.xlsx')}}" class="fw-bold text-secondary">Klik disini untuk download template</a></p>
                            <input class="form-control" type="file" id="formFileMultiple" name="file" accept=".xlsx" multiple required>
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
    function reset(token, id){
            swal({
            title: "Yakin Ingin Reset Data Pengguna?",
            text: "Password akan berubah menjadi NIK pengguna",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF5722",
            confirmButtonText: "Ya, Reset!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }).then(function () {
            var act = '/sekolah/resetpassword';
            $.post(act, { _token: token, id:id },
            function (data) {
                swal(
                'Berhasil!',
                'Data pengguna telah ter-reset.',
                'success'
                ).then(function () {
                    location.reload();
                })
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Batal',
                    'Langkah reset terhenti dan dibatalkan :)',
                    'error'
                    )
            }
        })
    }
</script>
@endsection
