@extends('Admin.layouts.main')
@section('title', 'BEWELL SQUARE | CONTACT')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Contact</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contact</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Contact</li>
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
                            <h4 class="card-title">Add Contact Detail</h4>
                        </div>
                        <div class="card-body">
                            <form id="save" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="address" class="required">Address</label>
                                            <textarea type="text" name="address" maxlength="50" id="address" class="form-control" placeholder="Enter address">{{ isset($Contact->address) ? $Contact->address : '' }}</textarea>
                                            <span class="invalid-feedback" id="address_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="phone1" class="required">Phone 1 [Must Be WhatsApp NO]</label>
                                            <input type="text" name="phone1" maxlength="15" id="phone1"
                                                class="form-control" placeholder="Enter Phone Number"
                                                value="{{ isset($Contact->phone1) ? $Contact->phone1 : '' }}">
                                            <span class="invalid-feedback" id="phone1_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="phone2">Phone 2</label>
                                            <input type="text" name="phone2" maxlength="15" id="phone2"
                                                class="form-control" placeholder="Enter Secondary Phone Number"
                                                value="{{ isset($Contact->phone2) ? $Contact->phone2 : '' }}">
                                            <span class="invalid-feedback" id="phone2_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email1" class="required">Email 1</label>
                                            <input type="email" name="email1" maxlength="100" id="email1"
                                                class="form-control" placeholder="Enter Primary Email"
                                                value="{{ isset($Contact->email1) ? $Contact->email1 : '' }}">
                                            <span class="invalid-feedback" id="email1_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email2">Email 2</label>
                                            <input type="email" name="email2" maxlength="100" id="email2"
                                                class="form-control" placeholder="Enter Secondary Email"
                                                value="{{ isset($Contact->email2) ? $Contact->email2 : '' }}">
                                            <span class="invalid-feedback" id="email2_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="opening_time" class="required">Opening Time</label>
                                            <input type="time" name="opening_time" id="opening_time" class="form-control"
                                                value="{{ isset($Contact->opening_time) ? $Contact->opening_time : '' }}">
                                            <span class="invalid-feedback" id="opening_time_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="closing_time" class="required">Closing Time</label>
                                            <input type="time" name="closing_time" id="closing_time"
                                                class="form-control"
                                                value="{{ isset($Contact->closing_time) ? $Contact->closing_time : '' }}">
                                            <span class="invalid-feedback" id="closing_time_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="opening_day" class="required">Opening Day</label>
                                            <select name="opening_day" id="opening_day" class="form-control">
                                                <option value="" disabled selected>Select Opening Day</option>
                                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    <option value="{{ $day }}"
                                                        {{ isset($Contact->opening_day) && $Contact->opening_day == $day ? 'selected' : '' }}>
                                                        {{ $day }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" id="opening_day_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="closing_day" class="required">Closing Day</label>
                                            <select name="closing_day" id="closing_day" class="form-control">
                                                <option value="" disabled selected>Select Closing Day</option>
                                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    <option value="{{ $day }}"
                                                        {{ isset($Contact->closing_day) && $Contact->closing_day == $day ? 'selected' : '' }}>
                                                        {{ $day }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" id="closing_day_error"></span>
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
                url: "{{ route('contact.store') }}",
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
