<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Hari</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahhari',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label for="hari" class="form-label">Hari Aktif</label>
            <input type="text" class="form-control" name="hari" id="hari" value="{{$data->nama}}">
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
