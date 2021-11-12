<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Kelas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahMP',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-6">
            <label for="nama_mp" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" id="nama_mp" name="nama_mp" value="{{$mp->nama_mp}}">
        </div>
        <div class="col-md-6">
            <label for="pengajar" class="form-label">Wali Kelas</label>
            <select name="pengajar" class="form-select" id="pengajar">
                @if(isset($dataGuru))
                    @foreach($dataGuru as $guru)
                    <?php $selected="" ?>
                    @if($guru->id == $mp->pengajar)
                    @php
                    $selected == "selected";
                    @endphp
                    @endif

                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                @else
                <option value="-" disabled>Tidak ada data Guru</option>
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
