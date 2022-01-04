<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Kompetensi Dasar</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahpresensi',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label for="nama_mp" class="form-label">Nama Mata Pelajaran : {{ $mata_pelajaran->nama_mp }}</label>
        </div>
        <div class="col-md-12">
            <label for="kelas" class="form-label">Kelas : {{$kelas->name_class}}</label>
        </div>
        <div class="col-md-12">
            <label for="materi" class="form-label">Materi</label>
            <input type="text" class="form-control" name="materi" id="materi" value="{{ $data->materi }}">
        </div>
        <div class="col-md-12">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" id="catatan" cols="10" rows="10" class="form-control" value="{{ $data->catatan_pertemuan }}"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
