<div class="offcanvas-header bg-danger text-white">
    <h5 id="offcanvasRightLabel">Edit Faq</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form id="update" autocomplete="off">
        @csrf
        @method('PUT')
        <input type="hidden" name="faq_id" id="edit_faq_id" value="{{ encrypt($faq->id)}}">

        <div class="form-group mb-3">
            <label for="title" class="required">title</label>
            <input type="text" name="title" required maxlength="50" id="edit_title" value="{{ $faq->title  }}" class="form-control" placeholder="Enter title">
            <span class="invalid-feedback" id="edit_title_error"></span>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="required">description</label>
            <input type="text" name="description" maxlength="50" id="edit_description" value="{{ $faq->description  }}" class="form-control" placeholder="Enter description">
            <span class="invalid-feedback" id="edit_description_error"></span>
        </div>

        <center>
            <button type="submit" id="update_faq_btn" class="btn btn-block btn-primary">update</button>
        </center>

    </form>

</div>
<script>
    $('#update').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('faq.update') }}",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('#update_faq_btn').attr('disabled', true);
                $('#update_faq_btn').html(window.spinner);
            },
        }).done((response, statusText, xhr) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_faq_btn').removeAttr('disabled');
            $('#update_faq_btn').html('update');


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
            $('#update_faq_btn').removeAttr('disabled');
            $('#update_faq_btn').html('update');

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