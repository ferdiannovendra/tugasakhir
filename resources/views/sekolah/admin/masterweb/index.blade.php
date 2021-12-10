@extends('layoutsadmin.adminsekolah')

@section('title')
Master Web
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
                <h6 class="mb-0 fw-bold ">Master Web</h6>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('update_masterweb')}}">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Logo</label>
                                <input type="file" name="logo" class="form-control">
                                @if($data->logo != null)
                                <img width="500px" height="500px" src="{{ asset('fileupload/'.$data->logo) }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Footer Text</label>
                                <input type="text" name="footer_text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Instagram</label>
                                <input type="text" name="instagram" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Facebook</label>
                                <input type="text" name="facebook" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Twitter</label>
                                <input type="text" name="twitter" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- Row end  -->
@endsection
