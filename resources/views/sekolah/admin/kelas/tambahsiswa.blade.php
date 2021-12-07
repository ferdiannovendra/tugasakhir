<div class="modal-header">
    <h5 class="modal-title h4" >Tambah Siswa di {{$kelas->name_class}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('tambah_siswa',$id) }}" method="post">
<div class="modal-body">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="nama_kelas" class="form-label">Jurusan :</label>
                <label for="nama_kelas" class="form-label"><b>{{$kelas->jurusan->nama_jurusan}}</b></label>
            </div>
            <div class="col-md-6">
                <label for="nama_kelas" class="form-label">Jurusan :</label>
                <select name="siswa[]" id="siswa" class="form-select" multiple size="10">

                </select>
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="nama_kelas" class="form-label">Semester / Tahun Ajaran :</label>
                <label for="nama_kelas" class="form-label"><b>{{ $kelas->semester->nama_semester }} - {{ $kelas->semester->tahun_ajaran }}</b></label>
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="nama_kelas" class="form-label">Wali Kelas :</label>
                <label for="nama_kelas" class="form-label"><b>{{ $kelas->user->nik }} - {{ $kelas->user->name }} {{ $kelas->user->lname }}</b></label>
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="siswa" class="form-label">Pilih Siswa :</label><br>
                <select name="siswa[]" id="siswa" class="form-select" multiple size="10">
                    @foreach($datasiswa as $s)
                    <option value="{{$s->user->id}}">{{$s->nisn}} - {{$s->user->name}} {{$s->user->lname}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="idsemester" value="{{$kelas->semester->idsemester}}">
        </div>
        <br>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
