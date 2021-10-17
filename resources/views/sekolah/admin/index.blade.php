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
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header mt-2 py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                <h6 class="mb-0 fw-bold ">Tambah Data Sekolah</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" required>
                        </div>
                        <div class="col-md-6">
                            <label  class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phonenumber" required>
                        </div>
                        <div class="col-md-6">
                            <label for="emailaddress" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="emailaddress" required>
                        </div>
                        <div class="col-md-6">
                            <label for="admitdate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="admitdate" required>
                        </div>
                        <div class="col-md-6">
                            <label for="admittime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="admittime" required>
                        </div>
                        <div class="col-md-6">
                            <label for="formFileMultiple" class="form-label"> File Upload</label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple required>
                        </div>
                        <div class="col-md-6">
                            <label  class="form-label">Gender</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios11" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios11">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios22" value="option2">
                                        <label class="form-check-label" for="exampleRadios22">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="addnote" class="form-label">Add Note</label>
                            <textarea  class="form-control" id="addnote" rows="3"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- Row end  -->
@endsection
@section('script')
<!-- Plugin Js-->
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>

<!-- Jquery Page Js -->
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/page/hr.js') }}"></script>
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
