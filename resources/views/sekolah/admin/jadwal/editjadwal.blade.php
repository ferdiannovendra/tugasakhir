<div class="modal-header">
    <h5 class="modal-title h4" >Ubah Jadwal</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div><form action="{{ route('postTambahJadwal') }}" method="post">
    <div class="modal-body">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-md-12">
                <label for="nama_mp" class="form-label">Nama Mata Pelajaran</label>
                <select name="matapelajaran" class="form-select" id="matapelajaran" required>
                    @if(isset($dataMP))
                        @foreach($dataMP as $mp)
                        @php
                            $selected = "";
                            if ($mp->idmata_pelajaran == $data->idmatapelajaran) {
                                $selected = " selected";
                            }
                        @endphp
                        <option value="{{ $mp->idmata_pelajaran }}" <?php echo $selected;?>>{{ $mp->nama_mp }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Mata Pelajaran</option>
                    @endif
                </select>
            </div>
            <div class="col-md-12">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="kelas" class="form-select" id="kelas" required>
                    @if(isset($kelas))
                        @foreach($kelas as $k)
                        @php
                            $selected = "";
                            if ($k->idclass_list == $data->idclass_list) {
                                $selected = " selected";
                            }
                        @endphp
                        <option value="{{ $k->idclass_list }}" <?php echo $selected;?>>{{ $k->name_class }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Kelas</option>
                    @endif
                </select>
            </div>
            <div class="col-md-4">
                <label for="hari" class="form-label">Nama Hari</label>
                <select name="hari" class="form-select" id="hari" required>
                    @if(isset($hari))
                        @foreach($hari as $k)
                        @php
                            $selected = "";
                            if ($k->id == $data->hari_id) {
                                $selected = " selected";
                            }
                        @endphp
                        <option value="{{ $k->id }}" <?php echo $selected;?>>{{ $k->nama }}</option>
                        @endforeach
                    @else
                    <option value="-" disabled>Tidak ada data Hari</option>
                    @endif
                </select>
            </div>
            <div class="col-md-4">
                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="{{ $data->jam_mulai }}">
            </div>
            <div class="col-md-4">
                <label for="jam_akhir" class="form-label">Jam Akhir</label>
                <input type="time" class="form-control" name="jam_akhir" id="jam_akhir" value="{{ $data->jam_akhir }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
