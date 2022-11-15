<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại bài viết</title>
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
            <div class="col-md-2"></div>
            <div class="col-md-8 bg-light">
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

                // if (isset($msg)) {
                //     echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
                // }
                // if (isset($error)) {
                //     echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                // }
                ?>
                <h2 class="my-2" style="text-align: center;">Thêm danh mục bài viết</h2>
                <form action="<?php echo BASE_URL; ?>post_category/insert_post_category" method="POST" class="my-2">
                    <div class="form-group">
                        <label for="title_post_category">Tên danh mục bài viết</label>
                        <input type="text" class="form-control" id="title_post_category" name="title_post_category" placeholder="Tên danh mục bài viết">
                    </div>
                    <div class="form-group">
                        <label for="desc_post_category">Mô tả danh mục bài viết</label>
                        <textarea class="form-control" id="desc_post_category" name="desc_post_category" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <!-- content -->

    <!-- scripts -->
    <?php include_once('app/views/admin/layouts/scripts.php'); ?>
    <!-- end scripts -->

    <script>
        $(document).ready(function() {
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



        });
    </script>

</body>

</html>