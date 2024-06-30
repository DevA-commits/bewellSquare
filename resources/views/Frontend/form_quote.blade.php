<style>
    .form {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 13px;
    }

    .box {
        padding: 10px;
        border-radius: unset;
        box-shadow: 8px 10px coral;  
        position: relative;
        background-color: white;
        /* Replace with your image path */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        overflow: hidden;
    }

    .box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.915); /* Black with 50% opacity */
        z-index: 1;
        backdrop-filter: blur(3px); /* Apply blur effect only to the background */
    }

    .box>.modal-body {
        position: relative;
        z-index: 2;
    }

    .form-control {
        border: none;
        border-radius: unset;
        background-color: transparent;
        border-bottom: 2px solid rgb(32, 40, 42);
        color: rgb(0, 0, 0);
        font-size: 13px;
        /* Optional: to add an underline */
    }

    .form-control:focus {
        box-shadow: none;
        color: rgb(19, 4, 33);
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: rgb(0, 0, 0);
        /* Ensure labels are visible on the dark overlay */
    }

    .invalid-feedback {
        color: rgb(255, 0, 0);
        font-size: 10px;
    }

    .btn {
        border-radius: unset;
    }
</style>



<div class="modal fade border bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg form">
        <div class="modal-content box">
            <div class="modal-body">
                <form id="save" autocomplete="off">
                    <h4 class="text-center text-black">Get A Quote</h4>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control"
                                placeholder="Enter Full Name">
                            <div class="invalid-feedback" id="fullname_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter Email">
                            <div class="invalid-feedback" id="email_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="Enter Phone Number">
                            <div class="invalid-feedback" id="phone_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="interior_design" class="form-label">Interior Design Preference</label>
                            <select id="interior_design" name="interior_design" class="form-control">
                                <option value="">Select</option>
                                <option value="Modern">Modern</option>
                                <option value="Traditional">Traditional</option>
                                <option value="Minimalist">Minimalist</option>
                                <option value="Industrial">Industrial</option>
                                <option value="Scandinavian">Scandinavian</option>
                            </select>
                            <div class="invalid-feedback" id="interior_design_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                placeholder="Enter Subject">
                            <div class="invalid-feedback" id="subject_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="4" placeholder="Enter Message"></textarea>
                            <div class="invalid-feedback" id="message_error"></div>
                        </div>
                    </div>
                    <div class="">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-dark text-light"
                                data-bs-dismiss="modal">Close</button>
                            <button id="save_btn" type="submit" class="btn btn-info w-25">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#save').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('home.quote') }}",
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
                $('#save_btn').html('submit');

                if (xhr.status == 201 || xhr.status == 200) {
                    $("#save")[0].reset();

                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your Request Send Successfully, We Will Connect You Soon!",
                        showConfirmButton: true,
                        timer: 3000
                    });

                    $('.modal').find('.btn-close').trigger('click');

                }
            }).fail((error) => {
                $(".error-text").text("");
                $(".form-control").removeClass("is-invalid");
                $('#save_btn').removeAttr('disabled');
                $('#save_btn').html('submit');

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
@endpush
