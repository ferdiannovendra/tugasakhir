<ul class="menu-list flex-grow-1 mt-3">
    <li><a class="m-link" href="{{ route('superadminhome') }}"><i class="icofont-ui-home"></i><span>Home</span></a></li>
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

</ul>
