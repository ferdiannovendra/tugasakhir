<br>
<hr>
@if ($namasekolah == "Silahkan koordinasi dengan dinas setempat")
<h5>Maaf Data Sekolah Belum Terdaftar pada <a href="https://referensi.data.kemdikbud.go.id/">referensi.data.kemdikbud.go.id</a></h5>
@else
    @if (str_contains($namasekolah,"SMK"))
    <div class="row g-3 align-items-center">
        <div class="col-md-12">
            <label class="form-label">Nama Sekolah</label>
            <h5>{{$namasekolah}}</h5>
        </div>
        <div class="col-md-12">
            <label class="form-label">Alamat</label>
            <h5>{{$alamat}}</h5>
        </div>
    </div>
    <button class="btn btn-primary mt-4" onclick="simpan()">Ajukan Pendaftaran</button>
    @else
        <h5>Maaf, data sekolah adalah {{$namasekolah}}, dan <u><b>bukan</b></u> Sekolah Menengah Kejuruan (SMK)</h5>
        <small>Sistem Informasi Akademik, hanya diperuntukkan pada SMK</small>
    @endif

@endif
