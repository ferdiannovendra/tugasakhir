<ul class="menu-list flex-grow-1 mt-3">
    <li><a class="m-link" href="{{ route('homeguru') }}"><i class="icofont-ui-home"></i><span>Home</span></a></li>
    <li class="collapsed">
        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#kelas">
        <i class="icofont-people"></i> <span>Kelas</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
        <!-- Menu: Sub menu ul -->
        <ul class="sub-menu collapse" id="kelas">
            <li><a class="ms-link" href="{{ route('list_kelas') }}"> <span>Daftar Kelas</span></a></li>
        </ul>
    </li>
    <li><a class="m-link" href="{{ route('presensi') }}"><i class="icofont-ui-home"></i><span>Presensi</span></a></li>
    <li><a class="m-link" href="{{ route('rencana_penilaian') }}"><i class="icofont-ui-home"></i><span>Rencana Penilaian</span></a></li>
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
</ul>
