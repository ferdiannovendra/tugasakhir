@extends('layoutsadmin.superadmin')

@section('title')
Super-Admin
@endsection

@section('style')
<!-- plugin css file  -->
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
@endsection

@section('isi-content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold py-3 mb-0">Detail Sekolah {{$data->name}}</h3>
                    <button onclick="generatedb('{{csrf_token()}}','{{$data->id}}')" type="button" class="btn btn-primary">Generate DB</button>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="list-view">
                <div class="row clearfix g-3">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Detail & Update</h6>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('simpanubah_tenant',$data->id) }}">
                                    @csrf
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-12">
                                        <label for="depone" class="form-label">Nama Sekolah</label>
                                        <input type="text" name="name" value="{{$data->name}}" class="form-control" id="depone">
                                        </div>
                                        <div class="col-sm-12">
                                        <label for="depone" class="form-label">NPSN</label>
                                        <input type="text" name="npsn" value="{{$data->npsn}}" class="form-control" id="depone">
                                        </div>
                                        <div class="col-sm-12">
                                        <label for="depone" class="form-label">Database</label>
                                        <input type="text" name="database" value="{{$data->database}}" class="form-control" id="depone">
                                        </div>
                                        <div class="col-sm-12">
                                        <label for="depone" class="form-label">Domain</label>
                                        <input type="text" name="domain" value="{{$data->domain}}" class="form-control" id="depone">
                                        </div>
                                        <div class="col-sm-6">
                                        <label for="abc" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{$data->start_date}}"id="abc">
                                        </div>
                                        <div class="col-sm-6">
                                        <label for="abc" class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" value="{{$data->end_date}}"id="abc">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <iframe src="http://{{$data->domain}}:8000" style="width: 100%;height: 500px;" name="myFrame"></iframe>

                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function generatedb(token,id){
        swal({
        title: "Yakin generate Database?",
        text: "Database baru akan terbentuk",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF5722",
        confirmButtonText: "Ya, Generate!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
        }).then(function () {
            var act = '/super-admin/generateDB';
            $.post(act, { _token: token, id:id },
            function (data) {
                console.log(data.status);
                // swal(
                // 'Terhapus!',
                // 'Database telah terbentuk.',
                // 'success'
                // ).then(function () {
                //     location.reload();
                // })
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Batal',
                    'Langkah generate terhenti dan dibatalkan :)',
                    'error'
                    )
            }
        })
    }
</script>
