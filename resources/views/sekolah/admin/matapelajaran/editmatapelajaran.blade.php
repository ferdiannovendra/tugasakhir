<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Kelas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahMP',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-5">
            <label for="nama_mp" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" id="nama_mp" name="nama_mp" value="{{$mp->nama_mp}}">
        </div>
        <div class="col-md-5">
            <label for="pengajar" class="form-label">Wali Kelas</label>
            <select name="pengajar" class="form-select" id="pengajar">
                @if(isset($dataGuru))
                    @foreach($dataGuru as $guru)
                    <?php $selected="" ?>
                    @if($guru->id == $mp->guru_pengajar)
                    <?php
                    $selected = " selected";
                    ?>
                    @endif

                    <option value="{{ $guru->id }}" <?php echo $selected; ?>>{{ $guru->name }}</option>
                    @endforeach
                @else
                <option value="-" disabled>Tidak ada data Guru</option>
                @endif
            </select>
        </div>
        <div class="col-md-2">
            <label for="skm" class="form-label">SKM</label>
            <input type="number" max="100" min="0" class="form-control" id="skm" name="skm" value="{{$mp->skm}}">
        </div>
        <div class="col-md-12">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-select" id="kategori">
                @if(isset($kategori))
                    @foreach($kategori as $k)
                    <?php $selected="" ?>
                    @if($k->id == $mp->id_kategori)
                    <?php
                    $selected = " selected";
                    ?>
                    @endif
                    <option value="{{ $k->id }}"<?php echo $selected; ?>>{{ $k->nama_kategori }}</option>
                    @endforeach
                @else
                <option value="-" disabled>Tidak ada data Kategori</option>
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
