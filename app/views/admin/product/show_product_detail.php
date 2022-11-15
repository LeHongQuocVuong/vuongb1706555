<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
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
                <h2 class="my-2" style="text-align: center;">Thông tin sản phẩm</h2>
                <?php if (isset($product) && $product != null) { ?>
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Tên sản phẩm</th>
                                <td><?php echo $product['title_product']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Giá sản phẩm</th>
                                <td><?php echo $product['price_product']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Giá cũ sản phẩm</th>
                                <td><?php echo $product['old_price_product']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Số lượng sản phẩm</th>
                                <td><?php echo $product['quantity_product']; ?></td>
                            </tr>

                            <?php if (isset($product['display_product_detail']) && $product['display_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Màn hình</th>
                                    <td><?php echo $product['display_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['os_product_detail']) && $product['os_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Hệ điều hành</th>
                                    <td><?php echo $product['os_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['main_camera_product_detail']) && $product['main_camera_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Camera sau</th>
                                    <td><?php echo $product['main_camera_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['selfie_camera_product_detail']) && $product['selfie_camera_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Camera trước</th>
                                    <td><?php echo $product['selfie_camera_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['cpu_product_detail']) && $product['cpu_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">CPU</th>
                                    <td><?php echo $product['cpu_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['ram_product_detail']) && $product['ram_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">RAM</th>
                                    <td><?php echo $product['ram_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['rom_product_detail']) && $product['rom_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Bộ nhớ trong</th>
                                    <td><?php echo $product['rom_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['battery_product_detail']) && $product['battery_product_detail'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Pin</th>
                                    <td><?php echo $product['battery_product_detail']; ?></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <th scope="row" style="min-width: 200px;">Danh mục sản phẩm</th>
                                <td><?php echo $product['title_category_product']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Nhà sản xuất</th>
                                <td><?php echo $product['title_product_producer']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" style="min-width: 200px;">Hình ảnh</th>
                                <td><img src="<?php if (isset($product['name_product_image']) && $product['name_product_image'] != "") {
                                                    echo $product['name_product_image'];
                                                } else {
                                                    echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                }  ?>" style="width: 100px;"></td>
                            </tr>
                            <?php if (isset($product['short_desc_product']) && $product['short_desc_product'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Mô tả ngắn</th>
                                    <td><?php echo $product['short_desc_product']; ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (isset($product['long_desc_product']) && $product['long_desc_product'] != "") { ?>
                                <tr>
                                    <th scope="row" style="min-width: 200px;">Mô tả dài</th>
                                    <td><?php echo $product['long_desc_product']; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                <?php } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">Không tìm thấy Sản phẩm!</div>';
                } ?>

            </div>
        </div>
    </div>
    <!-- content -->

    <!-- scripts -->
    <?php include_once('app/views/admin/layouts/scripts.php'); ?>
    <!-- end scripts -->

</body>

</html>