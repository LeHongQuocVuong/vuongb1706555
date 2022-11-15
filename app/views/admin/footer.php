<script src="<?php echo BASE_URL; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>vendor/datatables/datatables.min.js"></script>
<script src="<?php echo BASE_URL; ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?php echo BASE_URL; ?>vendor/ckeditor/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        // datatables
        var datatables = $("#datatables");
        if (typeof(datatables) != "undefined" && datatables !== null) {
            datatables.DataTable({
                "oLanguage": {
                    "sUrl": "<?php echo BASE_URL; ?>vendor/datatables/vi.json"
                }
            });
        }
        // datatables

        //Click button Delete
        var btn_delete_CategoryProduct = $(".btn-delete-CategoryProduct");
        btn_delete_CategoryProduct.on("click", function(e) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Bạn có chắc muốn xoá không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Huỷ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            url: $(this).data('url'),
                            type: 'GET'
                        })
                        .done(function(response) {
                            Swal.fire({
                                title: 'Đã xoá!',
                                icon: 'success'
                            }).then(function() {
                                location.reload();
                            })
                        })
                        .fail(function() {
                            Swal.fire({
                                title: 'Đã xảy ra lỗi',
                                icon: 'error'
                            })
                        });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Đã huỷ',
                        icon: 'error'
                    })
                }
            })

        });
        //Click button Delete

        // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
        var preview_img_container = $(".preview-img-container");
        if (typeof(preview_img_container) != "undefined" && preview_img_container !== null) {
            const reader = new FileReader();
            const fileInput = document.getElementById("name_product_image");
            const img = document.getElementById("preview-img");
            reader.onload = e => {
                img.src = e.target.result;
            }

            if (typeof(fileInput) != "undefined" && fileInput !== null) {
                fileInput.addEventListener('change', e => {
                    const f = e.target.files[0];
                    reader.readAsDataURL(f);
                })
            }
        }

        //Ckeditor

        if (typeof(document.getElementById("desc_post_ckeditor")) != "undefined" && document.getElementById("desc_post_ckeditor") !== null) {
            CKEDITOR.replace('desc_post_ckeditor');
        }

    });
</script>
</body>

</html>