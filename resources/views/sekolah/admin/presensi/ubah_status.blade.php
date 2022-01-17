<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Status Presensi</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('postUbahStatus') }}" method="post">
    @csrf
<div class="modal-body">
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label for="">Nama : {{ $user->name }} {{ $user->lname }}</label>
            <input type="hidden" name="iduser" value="{{ $data->idsiswa }}">
            <input type="hidden" name="idpresensi" value="{{ $data->idpresensi }}">
        </div>
        <div class="col-md-12">
            <label for="">Status Kehadiran</label>
            <select name="status" id="" class="form-select">
                <option value="0">Tidak Hadir</option>
                <option value="1">Hadir</option>
                <option value="2">Ijin</option>
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
