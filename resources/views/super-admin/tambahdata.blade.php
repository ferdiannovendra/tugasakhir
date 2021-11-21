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
<div class="row align-item-center">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Tambah Data Sekolah</h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('simpan_data_sekolah')}}">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama Sekolah</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nomor Pokok Sekolah Nasional (NPSN)</label>
                                <input type="text" name="npsn" class="form-control" required>
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
