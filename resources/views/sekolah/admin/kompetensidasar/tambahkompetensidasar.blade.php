@extends('layoutsadmin.adminsekolah')

@section('title')
Tambah Kelas
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
                <h6 class="mb-0 fw-bold ">Tambah Data Kompetensi Dasar</h6>
                <button type="button" class="btn btn-warning" onclick="tambahfield()">+ Tambah</button>
            </div>
            <div class="card-body">
                <form action="{{ route('postTambahKD') }}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Mata Pelajaran :</th>
                                    <th>Tingkat Pendidikan :</th>
                                    <th>Jenis :</th>
                                    <th>Semester :</th>
                                    <th>Kode KD :</th>
                                    <th>Kompetensi Dasar</th>
                                    <th>Ringkasan</th>
                                </tr>
                            </thead>
                            <tbody id="additem">
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td style="width:15%;">
                                        <select name="matapelajaran[]" class="form-select" id="matapelajaran" required>
                                            @if(isset($dataMP))
                                                @foreach($dataMP as $mp)
                                                <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                                                @endforeach
                                            @else
                                            <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td style="width:5%;">
                                        <select name="tingkatpendidikan[]" class="form-select" id="tingkatpendidikan" required>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </td>
                                    <td style="width:15%;">
                                        <select name="jenis[]" class="form-select" id="jenis" required>
                                            <option value="Pengetahuan">Pengetahuan</option>
                                            <option value="Keterampilan">Keterampilan</option>
                                        </select>
                                    </td>
                                    <td style="width:10%;">
                                        <select name="semester[]" class="form-select" id="semester" required>
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                    </td>
                                    <td style="width:10%;">
                                        <input type="text" class="form-control" id="kode_kd" name="kode_kd[]" required>
                                    </td>
                                    <td style="width:20%;">
                                        <textarea class="form-control" name="kompetensi_dasar[]" id="kompetensi_dasar"></textarea>
                                    </td>
                                    <td style="width:20%;">
                                        <textarea class="form-control" name="ringkasan[]" id="ringkasan"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
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
    var nomer = 2;
    function tambahfield(){
        $('#additem').append('<tr>'+
        '<td>'+ nomer +'</td>'+
        '<td style="width:15%;">'+
            '<select name="matapelajaran[]" class="form-select" id="matapelajaran">' +
                @if(isset($dataMP))
                    @foreach($dataMP as $mp)
                    '<option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>' +
                    @endforeach
                @else
                '<option value="-" disabled>Tidak ada data Mata Pelajaran</option>' +
                @endif
            '</select>'+
        '</td>'+
        '<td style="width:5%;">'+
            '<select name="tingkatpendidikan[]" class="form-select" id="tingkatpendidikan">'+
                '<option value="X">X</option>'+
                '<option value="XI">XI</option>'+
                '<option value="XII">XII</option>'+
           '</select>'+
        '</td>'+
        '<td style="width:5%;">'+
            '<select name="jenis[]" class="form-select" id="jenis">' +
               '<option value="Pengetahuan">Pengetahuan</option>'+
               '<option value="Keterampilan">Keterampilan</option>'+
            '</select>'+
        '</td>'+
        '<td style="width:10%;">'+
            '<select name="semester[]" class="form-select" id="semester">' +
                '<option value="1">Ganjil</option>' +
                '<option value="2">Genap</option>' +
            '</select>'+
        '</td>'+
        '<td style="width:10%;">'+
            '<input type="text" class="form-control" id="kode_kd" name="kode_kd[]" required>'+
        '</td>'+
        '<td style="width:20%;">'+
            '<textarea class="form-control" name="kompetensi_dasar[]" id="kompetensi_dasar"></textarea>'+
        '</td>'+
        '<td style="width:20%;">'+
            '<textarea class="form-control" name="ringkasan[]" id="ringkasan"></textarea>'+
        '</td>'+

        '</tr>');
        nomer++;
    }
</script>
@endsection
