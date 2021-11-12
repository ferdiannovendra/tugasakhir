<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Jurusan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahjurusan',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-6">
            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="{{$jurusan->nama_jurusan}}">
        </div>

        <div class="col-md-12">
            <label for="description" class="form-label">Add Note</label>
            <textarea  class="form-control" name="description" id="description" rows="3">{{$jurusan->description}}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
