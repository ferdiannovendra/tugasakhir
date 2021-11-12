<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Kelas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahkelas',$id) }}" method="post">
<div class="modal-body">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{$kelas->name_class}}">
            </div>

            <div class="col-md-6">
                <label for="wali_kelas" class="form-label">Wali Kelas</label>
                <select name="wali_kelas" class="form-select" id="wali_kelas">
                    @if(isset($dataGuru))
                        @foreach($dataGuru as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Guru</option>
                    @endif

                </select>
            </div>
        </div>
        <br>
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <label for="semester" class="form-label">Semester</label>
                <select name="semester" class="form-select" id="semester">
                    @if(isset($dataSemester))
                        @foreach($dataSemester as $semester)
                        <?php $selected="" ?>
                        @if($semester->idsemester == $kelas->semester_idsemester)
                        @php
                        $selected == "selected";
                        @endphp
                        @endif
                        <option value="{{ $semester->idsemester }}" <?php echo $selected;?>>{{ $semester->nama_semester }} - {{ $semester->tahun_ajaran }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data semester</option>
                    @endif

                </select>
            </div>

            <div class="col-md-6">
                <label for="jurusan" class="form-label">Jurusan</label>
                <select name="jurusan" class="form-select" id="jurusan">
                    @if(isset($dataJurusan))
                        @foreach($dataJurusan as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Jurusan</option>
                    @endif

                </select>
            </div>
        </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
