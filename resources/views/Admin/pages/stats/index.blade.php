@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | STATS')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Stats</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stats</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Stats</li>
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
                            <h4 class="card-title">Add Stats Detail</h4>
                        </div>
                        <div class="card-body">
                            <form id="save" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-5">
                                        <div class="form-group mb-3">
                                            <label for="image" class="required">Image</label>
                                            <input type="file" accept=".jpg, .png, .jpeg" class="form-control"
                                                id="image" name="image" onchange="previewImage(event)">
                                            <span class="invalid-feedback" id="image_error"></span>
                                        </div>
                                        @if ($image)
                                            <div class="mt-2">
                                                <img id="imagePreview" src="{{ $image }}" alt="Stats Image"
                                                    style="max-width: 100%; height: auto;">
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <img id="imagePreview" src="" alt="Stats Image"
                                                    style="display:none; max-width: 100%; height: auto;">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="experience" class="required">Experience</label>
                                            <input type="number" name="experience" id="experience"
                                                class="form-control" placeholder="Enter Experience"
                                                value="{{ isset($stats->experience) ? $stats->experience : '' }}">
                                            <span class="invalid-feedback" id="experience_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="projects" class="required">Projects</label>
                                            <input type="number" name="projects" id="projects"
                                                class="form-control" placeholder="Enter Projects"
                                                value="{{ isset($stats->projects) ? $stats->projects : '' }}">
                                            <span class="invalid-feedback" id="projects_error"></span>
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="repeat_customer" class="required">Repeat Customer</label>
                                            <input type="number" name="repeat_customer" id="repeat_customer"
                                                class="form-control" placeholder="Enter Repeat Customer"
                                                value="{{ isset($stats->repeat_customer) ? $stats->repeat_customer : '' }}">
                                            <span class="invalid-feedback" id="repeat_customer_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="client_satisfaction" class="required">Client Satisfaction</label>
                                            <input type="number" name="client_satisfaction" id="client_satisfaction"
                                                class="form-control" placeholder="Enter Client Satisfaction"
                                                value="{{ isset($stats->client_satisfaction) ? $stats->client_satisfaction : '' }}">
                                            <span class="invalid-feedback" id="client_satisfaction_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="worker" class="required">Worker</label>
                                            <input type="number" name="worker" id="worker"
                                                class="form-control" placeholder="Enter Worker"
                                                value="{{ isset($stats->worker) ? $stats->worker : '' }}">
                                            <span class="invalid-feedback" id="worker_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button id="save_btn" class="btn btn-success" type="submit">Update</button>
                                    </div>
                                </div>


                            </form>
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
                url: "{{ route('stats.store') }}",
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
                $('#save_btn').html('Update');

                if (xhr.status == 201) {
                    $("#save")[0].reset();
                    toastr(response.message, "bg-success");
                }
                if (xhr.status == 200) {
                    toastr(response.message, "bg-success");
                }
            }).fail((error) => {
                $(".error-text").text("");
                $(".form-control").removeClass("is-invalid");
                $('#save_btn').removeAttr('disabled');
                $('#save_btn').html('Update');

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
    </script>

    <script>
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
