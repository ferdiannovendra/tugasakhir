<ul class="menu-list flex-grow-1 mt-3">
    <li><a class="m-link" href="{{ route('superadminhome') }}"><i class="icofont-ui-home"></i><span>Home</span></a></li>
    <li><a class="m-link" href="{{ route('presensi.admin') }}"><i class="icofont-ui-home"></i><span>Presensi</span></a></li>
    <li><a class="m-link" href="{{ route('jadwalkelas') }}"><i class="icofont-ui-home"></i><span>Jadwal Pelajaran Kelas</span></a></li>
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
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#kelas">
            <i class="icofont-people"></i> <span>Kelas</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="kelas">
            <li><a class="ms-link" href="{{ route('daftarkelas') }}"> <span>Daftar Kelas</span></a></li>
        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#jurusan">
            <i class="icofont-hat-alt"></i> <span>Jurusan</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="jurusan">
            <li><a class="ms-link" href="{{ route('daftarjurusan') }}"> <span>Daftar Jurusan</span></a></li>
            <li><a class="ms-link" href="{{ route('tambahjurusan') }}"><span>Tambah Jurusan</span></a></li>

        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#matapelajaran">
            <i class="icofont-hat-alt"></i> <span>Mata Pelajaran</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="matapelajaran">
            <li><a class="ms-link" href="{{ route('daftarmatapelajaran') }}"> <span>Daftar Mata Pelajaran</span></a></li>
            <li><a class="ms-link" href="{{ route('daftarkategori') }}"> <span>Daftar Kategori</span></a></li>
        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#semester">
            <i class="icofont-search-stock"></i> <span>Semester</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="semester">
            <li><a class="ms-link" href="{{ route('daftarsemester') }}"> <span>Daftar Semester</span></a></li>
            <li><a class="ms-link" href=""><span>Tambah Semester</span></a></li>

        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#keuangan">
            <i class="icofont-money-bag"></i> <span>Keuangan</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="keuangan">
            <li><a class="ms-link" href="{{ route('daftarJenisPembayaran') }}"> <span>Jenis Pembayaran</span></a></li>
            <!-- <li><a class="ms-link" href=""><span>Tambah Semester</span></a></li> -->

        </ul>
    </li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#kd">
            <i class="icofont-data"></i> <span>Kompetensi Dasar</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="kd">
            <li><a class="ms-link" href="{{ route('daftarkompetensidasar') }}"> <span>Daftar Kompetensi Dasar</span></a></li>
            <!-- <li><a class="ms-link" href=""><span>Tambah Semester</span></a></li> -->

        </ul>
    </li>
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
    <li><a class="m-link" href="{{ route('lihatnilai-akhir') }}"><i class="icofont-ui-home"></i><span>Nilai Akhir</span></a></li>

    <!-- ================ Data Website ======================== -->
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#dataweb">
            <i class="icofont-people"></i> <span>Data Website</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="dataweb">
            <li><a class="ms-link" href="{{ route('masterweb') }}"> <span>Master Web</span></a></li>
            <li><a class="ms-link" href="{{ route('setting') }}"> <span>Setting</span></a></li>
        </ul>
    </li>


</ul>
