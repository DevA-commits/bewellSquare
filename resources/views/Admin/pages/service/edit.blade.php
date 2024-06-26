<div class="offcanvas-header bg-danger text-white">
    <h5 id="offcanvasRightLabel">Edit Service</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form id="update" autocomplete="off">
        @csrf
        @method('PUT')
        <input type="hidden" name="service_id" id="edit_service_id" value="{{ encrypt($service->id)}}">

        <div class="form-group mb-3">
            <label for="title" class="required">title</label>
            <input type="text" name="title" id="edit_title" value="{{ $service->title  }}" class="form-control" placeholder="Enter title">
            <span class="invalid-feedback" id="edit_title_error"></span>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="required">description</label>
            <input type="text" name="description" maxlength="50" id="edit_description" value="{{ $service->description  }}" class="form-control" placeholder="Enter description">
            <span class="invalid-feedback" id="edit_description_error"></span>
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="edit_image" accept=".svg" class="form-control">
            <div class="invalid-feedback" id="edit_image_error"></div>
        </div>
        <div class="mt-auto mb-3">

            <center>
                @php
                $url = url('assets/default-image.jpg');
                if ($service!=NULL) {
                $url = App\Models\service::ServiceImage($service->image);
                }
                @endphp
                <img class="edit-img-fluids" id="edit-preview-image" src="{{ $url }}" alt="service image" />
            </center>
        </div>


        <center>
            <button type="submit" id="update_service_btn" class="btn btn-block btn-primary">update</button>
        </center>

    </form>

</div>
<script>
    $("#edit_image").change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#edit-preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });



    $('#update').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('service.update') }}",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('#update_service_btn').attr('disabled', true);
                $('#update_service_btn').html(window.spinner);
            },
        }).done((response, statusText, xhr) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_service_btn').removeAttr('disabled');
            $('#update_service_btn').html('update');


            if (xhr.status == 200) {

                $("#datatable").DataTable().ajax.reload();

                let myOffCanvas = document.getElementById('offcanvasRight');
                let openedCanvas = bootstrap.Offcanvas.getInstance(myOffCanvas);
                openedCanvas.hide();
                toastr(response.message, "bg-success");
            }

        }).fail((error) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_service_btn').removeAttr('disabled');
            $('#update_service_btn').html('update');

            if (error.status == 422) {

                $.each(error.responseJSON, function(key, val) {
                    $("#edit_" + key).addClass("is-invalid");
                    $("#edit_" + key + "_error").text(val[0]);
                });
            } else {
                toastr(error.responseJSON.message, "bg-danger");
            }
        });
    });
</script>