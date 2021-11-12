<div class="modal-header">
    <h5 class="modal-title h4">Ubah Semester {{$sem->nama_semester}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahsemester',$id) }}" method="post">
<div class="modal-body">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="nama_semester" class="form-label">Nama Semester</label>
                <select name="nama_semester" class="form-select" id="nama_semester">
                    @if ($sem->nama_semester == 'ganjil')
                    <option value="ganjil" selected>Ganjil</option>
                    <option value="genap">Genap</option>
                    @else
                    <option value="ganjil">Ganjil</option>
                    <option value="genap" selected>Genap</option>
                    @endif
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Tahun Ajaran</label>
                <input type="text" class="form-control" name="tahun_ajaran" placeholder="Contoh: 2021/2022" value="{{$sem->tahun_ajaran}}">
            </div>
            <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="{{$sem->start_date}}" id="start_date">
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" value="{{$sem->end_date}}" id="end_date">
            </div>
        </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
