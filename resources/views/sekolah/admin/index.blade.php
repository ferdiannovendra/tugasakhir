@extends('layoutsadmin.adminsekolah')

@section('title')
Admin
@endsection

@section('style')
<!-- plugin css file  -->
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
@endsection

@section('isi-content')
<div class="row align-item-center">
    <div class="col-md-8">
        <div class="row align-item-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold ">Total Siswa</h6>
                        <h4 class="mb-0 fw-bold ">{{ $siswaCowok + $siswaCewek }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-3" id="apex-MainCategories-Siswa"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold ">Total Guru</h6>
                        <h4 class="mb-0 fw-bold ">{{ $guruCewek + $guruCowok }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-3" id="apex-MainCategories"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row align-item-center">
            <div class="col-md-6 col-lg-6 col-xl-12  flex-column">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-fill">
                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-users-alt-2 fs-5"></i></span>
                            <div class="d-flex flex-column ps-3  flex-fill">
                                <h6 class="fw-bold mb-0 fs-4">{{ $totalKelas }}</h6>
                                <span class="text-muted">Total Kelas (Rombongan Belajar)</span>
                            </div>
                            <i class="icofont-chart-bar-graph fs-3 text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-fill">
                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-holding-hands fs-5"></i></span>
                            <div class="d-flex flex-column ps-3 flex-fill">
                                <h6 class="fw-bold mb-0 fs-4">{{ $presensi }}</h6>
                                <span class="text-muted">Presensi Aktif Hari Ini</span>
                            </div>
                            <i class="icofont-chart-line fs-3 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Row end  -->
<br>
<div class="row align-item-center">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Jadwal Hari Ini</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Mata Pelajaran</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Akhir</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th>{{ $d->nama }}</th>
                            <td>{{ $d->idmata_pelajaran }}</td>
                            <td>{{ $d->nama_mp }}</td>
                            <td>{{ $d->jam_mulai }}</td>
                            <td>{{ $d->jam_akhir }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<!-- Plugin Js-->
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>

<!-- Jquery Page Js -->
<script src="{{ asset('js/template.js') }}"></script>
<script>
    // Employees Data
    $(document).ready(function() {
        var options = {
            align: 'center',
            chart: {
                height: 250,
                type: 'donut',
                align: 'center',
            },
            labels: ['Man', 'Women'],
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                show: true,
            },
            colors: ['var(--chart-color4)', 'var(--chart-color3)'],
            series: [{{$guruCewek}}, {{$guruCowok}}],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }
        var chart = new ApexCharts( document.querySelector("#apex-MainCategories"),options);
        chart.render();

        var options2 = {
            align: 'center',
            chart: {
                height: 250,
                type: 'donut',
                align: 'center',
            },
            labels: ['Man', 'Women'],
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                show: true,
            },
            colors: ['var(--chart-color4)', 'var(--chart-color3)'],
            series: [{{$siswaCowok}}, {{$siswaCewek}}],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }
        var chart2 = new ApexCharts( document.querySelector("#apex-MainCategories-Siswa"),options2);
        chart2.render();
    });

</script>
<script>
    $(document).ready(function() {
       $('#patient-table')
       .addClass( 'nowrap' )
       .dataTable( {
           responsive: true,
           columnDefs: [
               { targets: [-1, -3], className: 'dt-body-right' }
           ]
       });
   });

</script>
@endsection
