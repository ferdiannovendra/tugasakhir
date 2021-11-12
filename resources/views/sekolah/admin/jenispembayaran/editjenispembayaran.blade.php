<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Jenis Pembayaran</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahJenisPembayaran',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label for="nama_jenis" class="form-label">Nama Jenis Pembayaran</label>
            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="{{$pemb->nama_jenis}}">
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
