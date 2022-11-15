<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật bài viết</title>
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
                <?php if ($post != null) { ?>

                    <h2 class="my-2" style="text-align: center;">Thay đổi thông tin bài viết</h2>
                    <form action="<?php echo BASE_URL; ?>post/update_post/<?php echo $post['id_post'] ?>" method="POST" enctype="multipart/form-data" class="my-2">
                        <input value="<?php echo $post['old_image_name_post'] ?>" type="hidden" name="old_image_name_post">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title_post">Tên bài viết</label>
                                <input value="<?php echo $post['title_post'] ?>" type="text" class="form-control" id="title_post" name="title_post" placeholder="Tên bài viết">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="id_post_category">Danh mục bài viết</label>
                                <select name="id_post_category" class="custom-select">
                                    <option value="0" selected>----- Danh mục bài viết -----</option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option value="<?php echo $value['id_post_category']; ?>" <?php if ($value['title_post_category'] == $post['title_post_category']) {
                                                                                                        echo " selected";
                                                                                                    } ?>>
                                            <?php echo $value['title_post_category']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hình ảnh bài viết</label>
                            <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                            <div class="preview-img-container">
                                <img src="<?php if (isset($post['image_url_post']) && $post['image_url_post'] != "") {
                                                echo $post['image_url_post'];
                                            } else {
                                                echo BASE_URL . "public/uploads/posts/default-image_600.png";
                                            }  ?>" id="preview-img" width="200px">
                            </div>

                            <!-- Input cho phép người dùng chọn FILE -->
                            <input type="file" class="form-control" id="name_post_image" name="image_name_post">
                        </div>

                        <div class="form-group">
                            <label for="desc_post_ckeditor">Mô tả</label>
                            <textarea class="form-control" id="desc_post_ckeditor" name="desc_post" rows="3"><?php if (isset($post['desc_post'])) echo $post['desc_post'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                <?php } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">Không tìm thấy Bài viết!</div>';
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