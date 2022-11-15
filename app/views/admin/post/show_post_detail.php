<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài viết</title>
    <!-- css -->
    <?php include_once('app/views/admin/layouts/styles.php'); ?>
    <!-- end css -->
</head>

<body>

    <!-- menu -->
    <?php include_once('app/views/admin/menu.php'); ?>
    <!-- end menu -->

    <!-- content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-light">
                <?php

                if (isset($_SESSION['message'])) {
                    foreach ($_SESSION['message'] as $key => $value) {
                        echo '<div class="alert alert-success mt-2" role="alert">' . $value . '</div>';
                    }
                    Session::unset("message");
                }
                if (isset($_SESSION['error'])) {
                    foreach ($_SESSION['error'] as $key => $value) {
                        echo '<div class="alert alert-danger mt-2" role="alert">' . $value . '</div>';
                    }
                    Session::unset("error");
                }


                ?>
                <h2 class="my-2" style="text-align: center;">Thông tin bài viết</h2>
                <?php if (isset($post) && $post != null) { ?>
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Tên bài viết</th>
                                <td><?php echo $post['title_post']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Danh mục bài viết</th>
                                <td><?php echo $post['title_post_category']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Hình ảnh</th>
                                <td><img src="<?php if (isset($post['image_name_post']) && $post['image_name_post'] != "") {
                                                    echo $post['image_name_post'];
                                                } else {
                                                    echo BASE_URL . "public/uploads/posts/default-image_600.png";
                                                }  ?>" style="width: 100px;"></td>
                            </tr>

                            <?php if (isset($post['desc_post']) && $post['desc_post'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Mô tả</th>
                                    <td><?php echo $post['desc_post']; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                <?php } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">Không tìm thấy bài viết!</div>';
                } ?>

            </div>
        </div>
    </div>
    <!-- content -->

    <!-- scripts -->
    <?php include_once('app/views/admin/layouts/scripts.php'); ?>
    <!-- end scripts -->
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