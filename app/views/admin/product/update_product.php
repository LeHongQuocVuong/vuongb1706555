<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
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
                <?php if ($product != null) { ?>

                    <h2 class="my-2" style="text-align: center;">Thay đổi thông tin sản phẩm</h2>
                    <form action="<?php echo BASE_URL; ?>product/update_product/<?php echo $product['id_product'] ?>" method="POST" enctype="multipart/form-data" class="my-2">
                        <input value="<?php echo $product['id_product_image'] ?>" type="hidden" name="id_product_image">
                        <input value="<?php echo $product['id_product_detail'] ?>" type="hidden" name="id_product_detail">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title_product">Tên sản phẩm</label>
                                <input value="<?php echo $product['title_product'] ?>" type="text" class="form-control" id="title_product" name="title_product" placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price_product">Giá sản phẩm</label>
                                <input value="<?php echo $product['price_product'] ?>" type="text" class="form-control" id="price_product" name="price_product" placeholder="Giá sản phẩm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="old_price_product">Giá cũ sản phẩm</label>
                                <input value="<?php echo $product['old_price_product'] ?>" type="text" class="form-control" id="price_product" name="old_price_product" placeholder="Giá cũ sản phẩm">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="quantity_product">Số lượng sản phẩm</label>
                                <input value="<?php echo $product['quantity_product'] ?>" type="text" class="form-control" id="quantity_product" name="quantity_product" placeholder="Số lượng sản phẩm">
                            </div>
                            <!-- Detail -->
                            <div class="form-group col-md-6">
                                <label for="display_product_detail">Màn hình</label>
                                <input value="<?php if (isset($product['display_product_detail'])) echo $product['display_product_detail'] ?>" type="text" class="form-control" id="display_product_detail" name="display_product_detail" placeholder="Màn hình">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="os_product_detail">Hệ điều hành</label>
                                <input value="<?php if (isset($product['os_product_detail'])) echo $product['os_product_detail'] ?>" type="text" class="form-control" id="os_product_detail" name="os_product_detail" placeholder="Hệ điều hành">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="main_camera_product_detail">Camera sau</label>
                                <input value="<?php if (isset($product['main_camera_product_detail'])) echo $product['main_camera_product_detail'] ?>" type="text" class="form-control" id="main_camera_product_detail" name="main_camera_product_detail" placeholder="Camera sau">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="selfie_camera_product_detail">Camera trước</label>
                                <input value="<?php if (isset($product['selfie_camera_product_detail'])) echo $product['selfie_camera_product_detail'] ?>" type="text" class="form-control" id="selfie_camera_product_detail" name="selfie_camera_product_detail" placeholder="Camera trước">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cpu_product_detail">CPU</label>
                                <input value="<?php if (isset($product['cpu_product_detail'])) echo $product['cpu_product_detail'] ?>" type="text" class="form-control" id="cpu_product_detail" name="cpu_product_detail" placeholder="CPU">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ram_product_detail">RAM</label>
                                <input value="<?php if (isset($product['ram_product_detail'])) echo $product['ram_product_detail'] ?>" type="text" class="form-control" id="ram_product_detail" name="ram_product_detail" placeholder="RAM">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rom_product_detail">Bộ nhớ trong</label>
                                <input value="<?php if (isset($product['rom_product_detail'])) echo $product['rom_product_detail'] ?>" type="text" class="form-control" id="rom_product_detail" name="rom_product_detail" placeholder="Bộ nhớ trong">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="battery_product_detail">Pin</label>
                                <input value="<?php if (isset($product['battery_product_detail'])) echo $product['battery_product_detail'] ?>" type="text" class="form-control" id="battery_product_detail" name="battery_product_detail" placeholder="Pin">
                            </div>
                            <!-- Detail -->

                            <div class="form-group col-md-6">
                                <label for="id_category_product">Danh mục sản phẩm</label>
                                <select name="id_category_product" class="custom-select">
                                    <option value="0" selected>----- Danh mục sản phẩm -----</option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option value="<?php echo $value['id_category_product']; ?>" <?php if ($value['id_category_product'] == $product['id_category_product']) {
                                                                                                            echo " selected";
                                                                                                        } ?>>
                                            <?php echo $value['title_category_product']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_product_producer">Nhà sản xuất</label>
                                <select name="id_product_producer" class="custom-select">
                                    <option value="0" selected>----- Nhà sản xuất -----</option>
                                    <?php foreach ($product_producer as $key => $value) { ?>
                                        <option value="<?php echo $value['id_product_producer']; ?>" <?php if ($value['id_product_producer'] == $product['id_product_producer']) {
                                                                                                            echo " selected";
                                                                                                        } ?>>
                                            <?php echo $value['title_product_producer']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hình ảnh sản phẩm</label>
                            <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                            <div class="preview-img-container">
                                <img src="<?php if (isset($product['name_product_image']) && $product['name_product_image'] != "") {
                                                echo $product['name_product_image'];
                                            } else {
                                                echo BASE_URL . "public/uploads/products/default-image_600.png";
                                            }  ?>" id="preview-img" width="200px">
                            </div>

                            <!-- Input cho phép người dùng chọn FILE -->
                            <input type="file" class="form-control" id="name_product_image" name="name_product_image">
                        </div>
                        <div class="form-group">
                            <label for="short_desc_product">Mô tả ngắn</label>
                            <textarea class="form-control" id="short_desc_product" name="short_desc_product" rows="3"><?php if (isset($product['short_desc_product'])) echo $product['short_desc_product'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="long_desc_product">Mô tả dài</label>
                            <textarea class="form-control" id="long_desc_product" name="long_desc_product" rows="3"><?php if (isset($product['long_desc_product'])) echo $product['long_desc_product'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                <?php } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">Không tìm thấy danh mục sản phẩm!</div>';
                } ?>
            </div>

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