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
                <h6 class="mb-0 fw-bold ">Setting</h6>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('update_setting')}}">
                    @csrf
                    <div class="row g-3 align-items-center">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Semester</label>
                                <select name="semester" class="form-select" id="semester">
                                    @if(isset($semester))
                                        @foreach($semester as $semester)
                                        <option value="{{ $semester->idsemester }}"  @if($semester->idsemester == $data->idsemester) selected @endif>{{ $semester->nama_semester }} - {{ $semester->tahun_ajaran }}</option>
                                        @endforeach
                                    @else
                                    <option value="-" disabled>Tidak ada data semester</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Kepala Sekolah</label>
                                <select name="kepsek" class="form-select" id="kepsek">
                                    @if(isset($guru))
                                        @foreach($guru as $guru)
                                            <option value="{{ $guru->id }}" @if($guru->id == $data->kepala_sekolah) selected @endif>{{ $guru->name }}</option>
                                        @endforeach
                                    @else
                                    <option value="-" disabled>Tidak ada data Guru</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Presensi</label>
                                <select name="model_presensi" class="form-select" id="model_presensi">
                                        <?php $model = ["Harian","Satuan"] ?>

                                        @foreach($model as $p)
                                            <option value="{{ $p }}"  @if($p == $data->model_presensi) selected @endif>{{ $p }} </option>
                                        @endforeach
                                </select>
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
