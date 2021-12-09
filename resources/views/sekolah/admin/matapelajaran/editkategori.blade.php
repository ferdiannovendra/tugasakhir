<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Kelas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahKategoriMP',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{$kategori->nama_kategori}}">
        </div>

    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
