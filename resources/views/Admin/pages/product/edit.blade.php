<?php
function formatCategory($category)
{
    // Remove 'filter_' prefix
    $category = str_replace('filter_', '', $category);

    // Capitalize the first letter of each word
    $category = ucwords(str_replace('_', ' ', $category));

    return $category;
}
?>

<div class="offcanvas-header bg-danger text-white">
    <h5 id="offcanvasRightLabel">Edit Product</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form id="update" autocomplete="off">
        @csrf
        @method('PUT')
        <input type="hidden" name="product_id" id="edit_product_id" value="{{ encrypt($product->id) }}">

        <div class="form-group mb-3">
            <label for="title" class="required">title</label>
            <input type="text" name="title" required maxlength="50" id="edit_title" value="{{ $product->title }}"
                class="form-control" placeholder="Enter title">
            <span class="invalid-feedback" id="edit_title_error"></span>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="required">description</label>
            <input type="text" name="description" maxlength="50" id="edit_description"
                value="{{ $product->description }}" class="form-control" placeholder="Enter description">
            <span class="invalid-feedback" id="edit_description_error"></span>
        </div>

        <div class="form-group mb-3">
            <label for="category" class="required">Category</label>
            <input type="text"
                value="{{ formatCategory($product->category) }}" class="form-control" placeholder="Enter category"
                readonly>
            <input type="hidden" name="category" maxlength="50" id="edit_category"
                value="{{ ($product->category) }}" class="form-control" placeholder="Enter category"
                readonly>
            <span class="invalid-feedback" id="edit_category_error"></span>
        </div>


        <div class="form-group mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="edit_image" accept=".jpg, .png, .jpeg" class="form-control">
            <div class="invalid-feedback" id="edit_image_error"></div>
        </div>
        <div class="mt-auto mb-3">

            <center>
                @php
                    $url = url('assets/default-image.jpg');
                    if ($product != null) {
                        $url = App\Models\Product::ProductImage($product->image);
                    }
                @endphp
                <img class="edit-img-fluids" id="edit-preview-image" src="{{ $url }}" alt="product image" />
            </center>
        </div>


        <center>
            <button type="submit" id="update_product_btn" class="btn btn-block btn-primary">update</button>
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
            url: "{{ route('product.update') }}",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('#update_product_btn').attr('disabled', true);
                $('#update_product_btn').html(window.spinner);
            },
        }).done((response, statusText, xhr) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_product_btn').removeAttr('disabled');
            $('#update_product_btn').html('update');


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
            $('#update_product_btn').removeAttr('disabled');
            $('#update_product_btn').html('update');

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
