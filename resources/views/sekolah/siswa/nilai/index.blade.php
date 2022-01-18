@extends('layoutsadmin.adminsekolah')

@section('title')
Daftar Nilai
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
                <h6 class="mb-0 fw-bold ">Data Nilai</h6>
            </div>
            <div class="card-body">
                <label for="">Pilih Semester : </label>
                <select name="" id="semselect" class="form-select">

                    <option value="-" >Pilih Semester</option>
                    @foreach ($semester as $s)
                        <?php
                            $selected="";
                            if (isset($id)) {
                                if ($s->idsemester == $id) {
                                    $selected="selected";
                                }
                            }
                            ?>
                            <option value="/sekolah/siswa/lihatnilai/{{$s->idsemester}}" <?php echo $selected;?>>{{$s->nama_semester}} - {{$s->tahun_ajaran}}</option>
                    @endforeach
                </select>
                <br>
                <p style="text-transform: uppercase;">Semester : <b>{{$cekSemester->nama_semester}} - {{$cekSemester->tahun_ajaran}}</b></p>
                <hr>
                <h5>
                    <span class="badge bg-success">Hadir : {{$counthadir}}</span>
                    </h5>
                    <h5>
                    <span class="badge bg-danger">Tidak Hadir : {{$counttidakhadir}}</span>
                    </h5>
                    <h5>
                    <span class="badge bg-warning">Ijin : {{$countijin}}</span>
                    </h5>
                @if ($kelas != null)
                    @if ($cektagihan ==null)
                        <div class="table-responsive">
                            <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Mata Pelajaran</th>
                                        <th scope="col">Nilai Akhir Pengetahuan</th>
                                        <th scope="col">Nilai Akhir Keterampilan</th>
                                        <th scope="col">Nilai Akhir</th>
                                        <th scope="col">Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <th>{{ $d->idmatapelajaran }}</th>
                                    <td>{{ $d->nama_mp }}</td>
                                    @foreach ($da as $das)
                                        @if ($das->idmata_pelajaran == $d->idmatapelajaran)
                                        <td>{{ $das->nilai_pengetahuan }}</td>
                                        <td>{{ $das->nilai_keterampilan }}</td>
                                        <td>
                                            @if ($das->predikat != null)
                                            {{ $das->nilai_akhir }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $das->predikat }}
                                        </td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <form action="{{route('cetaknilai')}}" method="post">
                                @csrf
                                @php
                                 $value = "";
                                 if (isset($id)) {
                                     $value = $id;
                                 } else {
                                     $value = $cekSemester->idsemester;
                                 }
                                @endphp
                                <input type="hidden" name="idsemester" value="{{$value}}">
                                <button type="submit" class="btn btn-primary" >Cetak</button>
                            </form>

                        </div>
                    @else
                        <h5>Anda masih memiliki tagihan yang belum dibayar</h5>
                    @endif
                @else
                <h5>Tidak ada data</h5>
                @endif
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
   $('#semselect').on('change', function () {
    var url = $(this).val(); // get selected value
    window.location = url;
});
</script>
@endsection
