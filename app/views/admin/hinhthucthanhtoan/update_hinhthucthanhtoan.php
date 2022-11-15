<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật hình thức thanh toán</title>
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
                ?>
                <?php if ($hinhthucthanhtoan != null) { ?>

                    <h2 class="my-2" style="text-align: center;">Cập nhật hình thức thanh toán</h2>

                    <form action="<?php echo BASE_URL; ?>hinhthucthanhtoan/update_hinhthucthanhtoan/<?php echo $hinhthucthanhtoan[0]['httt_ma']; ?>" method="POST" class="my-2">
                        <div class="form-group">
                            <label for="httt_ten">Tên hình thức thanh toán</label>
                            <input type="text" class="form-control" id="httt_ten" name="httt_ten" placeholder="Tên hình thức thanh toán" value="<?php echo $hinhthucthanhtoan[0]['httt_ten']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="httt_desc">Mô tả hình thức thanh toán</label>
                            <textarea class="form-control" id="httt_desc" name="httt_desc" rows="3"><?php echo $hinhthucthanhtoan[0]['httt_desc']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                <?php } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">Không tìm thấy hình thức thanh toán!</div>';
                } ?>
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