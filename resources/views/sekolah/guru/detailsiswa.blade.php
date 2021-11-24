<div class="modal-header">
    <h5 class="modal-title h4" >Detail Siswa</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">Nama Lengkap</div>
        <div class="col-md-6">: {{$siswa->name}} {{$siswa->lname}}</div>

        <div class="col-md-6">Email</div>
        <div class="col-md-6">: {{$siswa->email}}</div>
        <div class="col-md-6">Alamat</div>
        <div class="col-md-6">: {{$siswa->address}}</div>
        <div class="col-md-6">No. Telp</div>
        <div class="col-md-6">: {{$siswa->phone}}</div>
        <div class="col-md-6">Agama</div>
        <div class="col-md-6">: {{$siswa->religion}}</div>
        <div class="col-md-6">Gender</div>
        <div class="col-md-6">: {{$siswa->gender}}</div>

        <hr>

        <div class="col-md-6">NIS</div>
        <div class="col-md-6">: {{$siswa->nis}}</div>
        <div class="col-md-6">NISN</div>
        <div class="col-md-6">: {{$siswa->nisn}}</div>
        <div class="col-md-6">Jurusan</div>
        <div class="col-md-6">: {{$jurusan->nama_jurusan}}</div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
