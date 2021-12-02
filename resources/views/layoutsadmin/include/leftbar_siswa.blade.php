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
    <li><a class="m-link" href="{{ route('presensi.siswa') }}"><i class="icofont-ui-home"></i><span>Presensi</span></a></li>

</ul>
