@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | BANNER')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Banner</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Banner</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Banner</li>
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
                            <h4 class="card-title">Add Banner Detail</h4>
                        </div>
                        <div class="card-body">
                            <form id="save" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="image" class="required">Image</label>
                                            <input type="file" accept=".jpg, .png, .jpeg" class="form-control"
                                                id="image" name="image" onchange="previewImage(event)">
                                            <span class="invalid-feedback" id="image_error"></span>
                                        </div>
                                        @if ($image)
                                            <div class="mt-2">
                                                <img id="imagePreview" src="{{ $image }}" alt="Banner Image"
                                                    style="max-width: 100%; height: auto;">
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <img id="imagePreview" src="" alt="Banner Image"
                                                    style="display:none; max-width: 100%; height: auto;">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title" class="required">Title</label>
                                            <input type="text" name="title" maxlength="50" id="title"
                                                class="form-control" placeholder="Enter title"
                                                value="{{ isset($banner->title) ? $banner->title : '' }}">
                                            <span class="invalid-feedback" id="title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="required">Description</label>
                                            <textarea type="text" name="description" id="description"
                                                class="form-control" placeholder="Enter description"
                                            >{{ isset($banner->description) ? $banner->description : '' }}</textarea>
                                            <span class="invalid-feedback" id="description_error"></span>
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
                url: "{{ route('banner.store') }}",
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
