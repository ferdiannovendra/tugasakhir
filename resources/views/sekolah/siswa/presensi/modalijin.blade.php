<div class="modal-header">
    <h5 class="modal-title h4" >Detail Siswa</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ijin') }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-6">
            <label for="nama_jurusan" class="form-label">ID Presensi : {{ $idpresensi }}</label>
            <input type="hidden" name="idpresensi" value="{{ $idpresensi }}">
        </div>

        <div class="col-md-12">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea  class="form-control" name="alasan" id="alasan" rows="3"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
</div>
</form>
