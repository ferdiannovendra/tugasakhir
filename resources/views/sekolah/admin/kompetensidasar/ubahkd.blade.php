<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Kompetensi Dasar</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('simpan_ubahkd',$id) }}" method="post">
<div class="modal-body">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label for="nama_jurusan" class="form-label">Mata Pelajaran</label>
            <select name="matapelajaran" class="form-select" id="matapelajaran">
                @if(isset($dataMP))
                    @foreach($dataMP as $mp)
                    <option value="{{ $mp->idmata_pelajaran }}">{{ $mp->nama_mp }}</option>
                    @endforeach
                @else
                <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                @endif
            </select>
        </div>

        <div class="col-md-6">
            <label for="tingkatpendidikan" class="form-label">Kode KD</label>
            <select name="tingkatpendidikan" class="form-select" id="tingkatpendidikan">
                @if($kd->tingkat_pendidikan == 'X')
                <option value="X" selected>X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
                @elseif($kd->tingkat_pendidikan == 'XI')
                <option value="X">X</option>
                <option value="XI" selected>XI</option>
                <option value="XII">XII</option>
                @else
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII" selected>XII</option>
                @endif
            </select>
        </div>
        <div class="col-md-6">
            <label for="kode_kd" class="form-label">Kode KD</label>
            <select name="jenis" class="form-select" id="jenis" required>
                @if($kd->jenis_kd == "Pengetahuan")
                <option value="Pengetahuan" selected>Pengetahuan</option>
                <option value="Keterampilan">Keterampilan</option>
                @else
                <option value="Pengetahuan">Pengetahuan</option>
                <option value="Keterampilan" selected>Keterampilan</option>
                @endif
            </select>
        </div>
        <div class="col-md-3">
            <label for="semester" class="form-label">Semester</label>
            <select name="semester" class="form-select" id="semester" required>
                @if($kd->semester == '1')
                <option value="1" selected>Ganjil</option>
                <option value="2">Genap</option>
                @else
                <option value="1">Ganjil</option>
                <option value="2" selected>Genap</option>
                @endif
            </select>

        </div>
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" id="status" required>
                @if($kd->status == 'Aktif')
                <option value="Aktif" selected>Aktif</option>
                <option value="Non-Aktif">Non-Aktif</option>
                @else
                <option value="Aktif">Aktif</option>
                <option value="Non-Aktif" selected>Non-Aktif</option>
                @endif
            </select>

        </div>
        <div class="col-md-6">
            <label for="kode_kd" class="form-label">Kode KD</label>
            <input type="text" class="form-control" id="kode_kd" name="kode_kd" value="{{$kd->kode_kd}}">
        </div>
        <div class="col-md-12">
            <label for="kompetensi_dasar" class="form-label">Kompetensi Dasar</label>
            <textarea class="form-control" name="kompetensi_dasar" id="kompetensi_dasar">{{$kd->kompetensi_dasar}}</textarea>
        </div>
        <div class="col-md-12">
            <label for="ringkasan" class="form-label">Ringkasan</label>
            <textarea class="form-control" name="ringkasan" id="ringkasan">{{$kd->ringkasan_deskripsi}}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
