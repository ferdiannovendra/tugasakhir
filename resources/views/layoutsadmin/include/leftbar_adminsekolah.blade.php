<ul class="menu-list flex-grow-1 mt-3">
    <li><a class="m-link" href="{{ route('adminsekolahnhome') }}"><i class="icofont-ui-home"></i><span>Home</span></a></li>
    <li><a class="m-link" href="{{ route('presensi.admin') }}"><i class="icofont-files-stack"></i><span>Presensi</span></a></li>
    <li><a class="m-link" href="{{ route('jadwalkelas') }}"><i class="icofont-black-board"></i><span>Jadwal Pelajaran Kelas</span></a></li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#user">
            <i class="icofont-ui-user"></i> <span>Pengguna</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="user">
            <li><a class="ms-link" href="{{ route('daftarUser') }}"> <span>Daftar Semua Pengguna</span></a></li>
            <li><a class="ms-link" href="{{ route('daftarGuru') }}"><span>Daftar Guru</span></a></li>
            <li><a class="ms-link" href="{{ route('daftarSiswa') }}"><span>Daftar Siswa</span></a></li>
        </ul>
    </li>
    <li><a class="m-link" href="{{ route('daftarkelas') }}"><i class="icofont-people"></i><span>Kelas</span></a></li>
    <li><a class="m-link" href="{{ route('daftarjurusan') }}"><i class="icofont-hat-alt"></i><span>Jurusan</span></a></li>

    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#matapelajaran">
            <i class="icofont-hat-alt"></i> <span>Mata Pelajaran</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="matapelajaran">
            <li><a class="ms-link" href="{{ route('daftarmatapelajaran') }}"> <span>Daftar Mata Pelajaran</span></a></li>
            <li><a class="ms-link" href="{{ route('daftarkategori') }}"> <span>Daftar Kategori</span></a></li>
        </ul>
    </li>
    <li><a class="m-link" href="{{ route('daftarsemester') }}"><i class="icofont-search-stock"></i><span>Semester</span></a></li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#keuangan">
            <i class="icofont-money-bag"></i> <span>Keuangan</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="keuangan">
            <li><a class="ms-link" href="{{ route('daftarJenisPembayaran') }}"> <span>Jenis Pembayaran</span></a></li>
            <li><a class="ms-link" href="{{ route('daftarrekapkeuangan') }}"> <span>Daftar Rekap Keuangan</span></a></li>

        </ul>
    </li>
    <li><a class="m-link" href="{{ route('daftarkompetensidasar') }}"><i class="icofont-data"></i><span>Kompetensi Dasar</span></a></li>

    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#rencananilai">
            <i class="icofont-data"></i> <span>Rencana Penilaian</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="rencananilai">
            <li><a class="ms-link" href="{{ route('rencana_penilaian_admin') }}"><span>Penilaian Pengetahuan</span></a></li>
            <li><a class="ms-link" href="{{ route('rencana_penilaian_keterampilan_admin') }}"><span>Penilaian Keterampilan</span></a></li>
            <li><a class="ms-link" href="{{ route('rencana_bobot') }}"><span>Perncanaan Bobot</span></a></li>
        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#inputnilai">
            <i class="icofont-data"></i> <span>Input Penilaian</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="inputnilai">
            <li><a class="ms-link" href="{{ route('input_pengetahuan') }}"><span>Input Pengetahuan</span></a></li>
            <li><a class="ms-link" href="{{ route('input_keterampilan') }}"><span>Input Keterampilan</span></a></li>
        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#lihatolahnilai">
            <i class="icofont-data"></i> <span>Lihat Pengolahan Nilai</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="lihatolahnilai">
            <li><a class="ms-link" href="{{ route('olahnilai_pengetahuan') }}"><span>Nilai Pengetahuan</span></a></li>
            <li><a class="ms-link" href="{{ route('olahnilai_keterampilan') }}"><span>Nilai Keterampilan</span></a></li>
        </ul>
    </li>
    <li><a class="m-link" href="{{ route('lihatnilai-akhir') }}"><i class="icofont-ui-rate-blank"></i><span>Nilai Akhir</span></a></li>
    <li><a class="m-link" href="{{ route('lihatnilai-rapor') }}"><i class="icofont-ui-rating"></i><span>Nilai Rapor</span></a></li>

    <!-- ================ Data Website ======================== -->
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#dataweb">
            <i class="icofont-ui-settings"></i> <span>Data Website</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="dataweb">
            <li><a class="ms-link" href="{{ route('masterweb') }}"> <span>Master Web</span></a></li>
            <li><a class="ms-link" href="{{ route('setting') }}"> <span>Setting</span></a></li>
        </ul>
    </li>


</ul>
