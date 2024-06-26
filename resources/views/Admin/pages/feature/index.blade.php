@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | FEATURE')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Features</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Features</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Features</li>
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
                            <h4 class="card-title">Add Features</h4>
                        </div>
                        <div class="card-body">
                            <div class=" text-center">
                                <h6 class="bg-warning p-2"><span class="bg-danger px-2 py-1 note fw-bold">Note</span> :
                                    Image dimension must be in the pixel of- <a
                                        class="bg-light p-1">1000 X 700 pixel</a></h6>
                            </div>  
                            <form id="save" autocomplete="off">
                                @csrf
                                <div class="row pt-4">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="required">Image 1</label>
                                            <input type="file" accept=".jpg, .png, .jpeg" class="form-control"
                                                id="image" name="image" onchange="previewImageOne(event)">
                                            <span class="invalid-feedback" id="image_error"></span>
                                            @if ($image_one)
                                                <div class="mt-2">
                                                    <img id="imagePreviewOne" src="{{ $image_one }}" alt="Feature Image"
                                                        style="max-width: 100%; height: auto;">
                                                </div>
                                            @else
                                                <div class="mt-2">
                                                    <img id="imagePreviewOne" src="" alt="Feature Image"
                                                        style="display:none; max-width: 100%; height: auto;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image2" class="required">Image 2</label>
                                            <input type="file" accept=".jpg, .png, .jpeg" class="form-control"
                                                id="image2" name="image2" onchange="previewImageTwo(event)">
                                            <span class="invalid-feedback" id="image2_error"></span>
                                            @if ($image_two)
                                                <div class="mt-2">
                                                    <img id="imagePreviewTwo" src="{{ $image_two }}" alt="Feature Image"
                                                        style="max-width: 100%; height: auto;">
                                                </div>
                                            @else
                                                <div class="mt-2">
                                                    <img id="imagePreviewTwo" src="" alt="Feature Image"
                                                        style="display:none; max-width: 100%; height: auto;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image3" class="required">Image 3</label>
                                            <input type="file" accept=".jpg, .png, .jpeg" class="form-control"
                                                id="image3" name="image3" onchange="previewImageThree(event)">
                                            <span class="invalid-feedback" id="image3_error"></span>
                                            @if ($image_three)
                                                <div class="mt-2">
                                                    <img id="imagePreviewThree" src="{{ $image_three }}"
                                                        alt="Feature Image" style="max-width: 100%; height: auto;">
                                                </div>
                                            @else
                                                <div class="mt-2">
                                                    <img id="imagePreviewThree" src="" alt="Feature Image"
                                                        style="display:none; max-width: 100%; height: auto;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="title" class="required">Title One</label>
                                            <input type="text" name="title" maxlength="50" id="title"
                                                class="form-control" placeholder="Enter title"
                                                value="{{ isset($feature->title) ? $feature->title : '' }}">
                                            <span class="invalid-feedback" id="title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="title2" class="required">Title Two</label>
                                            <input type="text" name="title2" maxlength="50" id="title2"
                                                class="form-control" placeholder="Enter title2"
                                                value="{{ isset($feature->title2) ? $feature->title2 : '' }}">
                                            <span class="invalid-feedback" id="title2_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="description" class="required">Description One</label>
                                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description">{{ isset($feature->description) ? $feature->description : '' }}</textarea>
                                            <span class="invalid-feedback" id="description_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="description2" class="required">Description Two</label>
                                            <textarea name="description2" id="description2" class="form-control" rows="5"
                                                placeholder="Enter description2">{{ isset($feature->description2) ? $feature->description2 : '' }}</textarea>
                                            <span class="invalid-feedback" id="description2_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="describe_one" class="required">Describe One</label>
                                            <input type="text" name="describe_one" maxlength="50" id="describe_one"
                                                class="form-control" placeholder="Enter describe one"
                                                value="{{ isset($feature->describe_one) ? $feature->describe_one : '' }}">
                                            <span class="invalid-feedback" id="describe_one_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="describe_two" class="required">Describe Two</label>
                                            <input type="text" name="describe_two" maxlength="50" id="describe_two"
                                                class="form-control" placeholder="Enter describe two"
                                                value="{{ isset($feature->describe_two) ? $feature->describe_two : '' }}">
                                            <span class="invalid-feedback" id="describe_two_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="describe_three" class="required">Describe Three</label>
                                            <input type="text" name="describe_three" maxlength="50"
                                                id="describe_three" class="form-control"
                                                placeholder="Enter describe three"
                                                value="{{ isset($feature->describe_three) ? $feature->describe_three : '' }}">
                                            <span class="invalid-feedback" id="describe_three_error"></span>
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
                url: "{{ route('feature.store') }}",
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
                    $("#banks_datatable").DataTable().ajax.reload();
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
        function previewImageOne(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('imagePreviewOne');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }

        function previewImageTwo(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('imagePreviewTwo');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }

        function previewImageThree(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('imagePreviewThree');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
@endpush
