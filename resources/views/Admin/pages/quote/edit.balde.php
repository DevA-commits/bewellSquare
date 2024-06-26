<div class="offcanvas-header bg-danger text-white">
    <h5 id="offcanvasRightLabel">Edit Status</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form id="update" autocomplete="off">
        @csrf
        @method('PUT')
        <input type="hidden" name="quote_id" id="edit_quote_id" value="{{ encrypt($quote->id)}}">

        <div class="form-group mb-3">
            <label for="title" class="required">Status</label>
            <select name="category" id="category" class="form-control">
                <option value="">Select Status</option>
                <option value="pending">Pending</option>
                <option value="consolidation">consolidated</option>
                <option value="completed">Completed</option>
            </select>
            <span class="invalid-feedback" id="edit_category_error"></span>
        </div>

        <center>
            <button type="submit" id="update_quote_btn" class="btn btn-block btn-primary">update</button>
        </center>

    </form>

</div>
<script>
    $('#update').submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('quote.update') }}",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $('#update_quote_btn').attr('disabled', true);
                $('#update_quote_btn').html(window.spinner);
            },
        }).done((response, statusText, xhr) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_quote_btn').removeAttr('disabled');
            $('#update_quote_btn').html('update');


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
            $('#update_quote_btn').removeAttr('disabled');
            $('#update_quote_btn').html('update');

            if (error.status == 422) {

                $.each(error.responseJSON, function (key, val) {
                    $("#edit_" + key).addClass("is-invalid");
                    $("#edit_" + key + "_error").text(val[0]);
                });
            } else {
                toastr(error.responseJSON.message, "bg-danger");
            }
        });
    });
</script>