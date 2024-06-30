@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | SITE SETTING')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Site Setting</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Setting</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Site Setting</li>
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
                            <h4 class="card-title">Add Site Setting Detail</h4>
                        </div>
                        <div class="card-body">
                            <form id="save" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="image" class="required">Image</label>
                                            <input type="file" accept=".ico" class="form-control"
                                                id="image" name="image" onchange="previewImage(event)">
                                            <span class="invalid-feedback" id="image_error"></span>
                                        </div>
                                         @if ($site_image)
                                            <div class="mt-2">
                                                <img id="imagePreview" src="{{ $site_image }}" alt="Site Setting Image"
                                                    style="max-width: 100%; height: auto;">
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <img id="imagePreview" src="" alt="Site Setting Image"
                                                    style="display:none; max-width: 100%; height: auto;">
                                            </div>
                                        @endif 
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
                url: "{{ route('site.store') }}",
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
