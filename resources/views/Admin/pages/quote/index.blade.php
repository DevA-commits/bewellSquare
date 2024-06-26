@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | QUOTE')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Quote</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Quote</a></li>
                                <li class="breadcrumb-item active">Manage Quote</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Quote</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Interior Design</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('Admin._includes.offcanvas.right')
    @include('Admin._includes.modals.delete_modal')
@endsection

@push('scripts')
    <script src="{{ url('assets/js/main/canvas.js') }}"></script>
    <script src="{{ url('assets/js/main/delete.js') }}"></script>

    <script>
        $("#datatable").DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "",
            },
            ordering: false,
            processing: false,
            serverSide: true,
            serverMethod: "POST",
            ajax: {
                url: "{{ route('quote.datatable') }}",
                beforeSend: () => {
                    // Here, manually add the loading message.
                    $("#banks_datatable > tbody").html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="7" class="dataTables_empty">Loading&hellip;</td>' +
                        "</tr>"
                    );
                },
            },
            columns: [{
                    data: "sl",
                }, {
                    data: "fullname",
                }, {
                    data: "email",
                }, {
                    data: "phone",
                }, {
                    data: "interior_design",
                }, {
                    data: "subject",
                }, {
                    data: "message",
                },
                {
                    data: "status",
                }
            ],
        });
    </script>
@endpush
