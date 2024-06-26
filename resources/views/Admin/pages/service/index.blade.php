@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | SERVICES')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Service</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Service</a></li>
                                <li class="breadcrumb-item active">Manage Service</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Add Service</h4>
                        </div>
                        <div class="card-body">
                            <form id="save" autocomplete="off">
                                @csrf
                                <div class=" text-center">
                                    <h6 class="bg-warning p-2"><span class="bg-danger px-2 py-1 note fw-bold">Note</span> :
                                        Must Use Bootstrap Icon for SVG Image. Link to download Icons - <a
                                            href="https://icons.getbootstrap.com/" target="_blank"
                                            class="bg-light p-1">https://icons.getbootstrap.com/</a></h6>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="image" class="required">SVG Image</label>
                                            <input type="file" accept=".svg" class="form-control" id="image"
                                                name="image" onchange="previewImage(event)">
                                            <div class="mt-2">
                                                <img id="imagePreview" src="" alt="Service Image"
                                                    style="display:none; max-width: 100%; height: auto;">
                                            </div>
                                            <span class="invalid-feedback" id="image_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label for="title" class="required">Title</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control" placeholder="Enter title"
                                                value="{{ isset($banner->title) ? $banner->title : '' }}">
                                            <span class="invalid-feedback" id="title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group mb-3">
                                            <label for="description" class="required">Description</label>
                                            <input type="text" name="description" maxlength="100" id="description"
                                                class="form-control" placeholder="Enter description"
                                                value="{{ isset($banner->description) ? $banner->description : '' }}">
                                            <span class="invalid-feedback" id="description_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button id="save_btn" class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Service</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th class="w-50">Description</th>
                                            <th>Action</th>
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
        $('#save').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('service.store') }}",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $('#save_btn').attr('disabled', true);
                    $('#save_btn').html(window.spinner);
                },
            }).done((response, statusText, xhr) => {
                $(".error-text").text("");
                $(".form-control").removeClass("is-invalid");
                $('#save_btn').removeAttr('disabled');
                $('#save_btn').html('Submit');

                if (xhr.status == 201) {
                    $("#save")[0].reset();
                    $("#datatable").DataTable().ajax.reload();
                    toastr(response.message, "bg-success");
                }
                if (xhr.status == 200) {
                    toastr(response.message, "bg-success");
                }
            }).fail((error) => {
                $(".error-text").text("");
                $(".form-control").removeClass("is-invalid");
                $('#save_btn').removeAttr('disabled');
                $('#save_btn').html('Submit');

                if (error.status == 422) {
                    $.each(error.responseJSON, function(key, val) {
                        $("#" + key).addClass("is-invalid");
                        $("#" + key + "_error").text(val[0]);
                    });
                } else {
                    toastr(error.responseJSON.message, "bg-danger");
                }
            });
        });

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
                url: "{{ route('service.datatable') }}",
                beforeSend: () => {
                    // Here, manually add the loading message.
                    $("#banks_datatable > tbody").html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="5" class="dataTables_empty">Loading&hellip;</td>' +
                        "</tr>"
                    );
                },
            },
            columns: [{
                    data: "sl",
                }, {
                    data: "image",
                }, {
                    data: "title",
                }, {
                    data: "description",
                }, {
                    data: "action",
                }

                ,
            ],
        });

        function previewImage(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('imagePreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
@endpush
