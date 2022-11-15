<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Đơn hàng | Lê Hồng Quốc Vương</title>

    <!-- css -->
    <?php include_once('app/views/admin/layouts/styles.php'); ?>
    <!-- end css -->
    <style>
        .hinhdaidien {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- menu -->
    <?php include_once('app/views/admin/menu.php'); ?>
    <!-- end menu -->
    <div class="container mt-4 bg-light">
        <!-- Thông báo -->
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
        } ?>
        <!-- Thông báo -->

        <!-- content -->


        <h1 class="text-center">Chi tiết đơn đặt hàng</h1>
        <h3 class="text-center">Thông tin khách hàng</h3>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th scope="row">Tên khách hàng:</th>
                    <td><?= $customer['kh_ten'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Địa chỉ:</th>
                    <td><?= $customer['kh_diachi'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Số điện thoại:</th>
                    <td><?= $customer['kh_dienthoai'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Email:</th>
                    <td><?= $customer['kh_email'] ?></td>
                </tr>
            </tbody>
        </table>
        <h3 class="text-center">Thông tin Đơn đặt hàng</h3>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th scope="row">Ngày đặt hàng:</th>
                    <td><?= $order['dh_ngaylap'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Địa chỉ giao hàng:</th>
                    <td><?= $order['dh_noigiao'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Hình thức thanh toán:</th>
                    <td><?= $order['httt_ten'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Trạng thái thanh toán:</th>
                    <td><?= $order['dh_trangthaithanhtoan'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Tổng tiền:</th>
                    <td><?= number_format($order['dh_tongtien'], 0) . ' VNĐ'  ?></td>
                </tr>
            </tbody>
        </table>
        <h3 class="text-center">Chi tiết đơn hàng</h3>
        <div class="row">
            <div class="col col-md-12">
                <table id="tblGioHang" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh đại diện</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="datarow">
                        <?php $stt = 1; ?>
                        <?php foreach ($data_order as $sanpham) : ?>
                            <tr>
                                <td><?php echo $stt;
                                    $stt += 1; ?></td>
                                <td>
                                    <img src="<?php if (isset($sanpham['name_product_image']) && $sanpham['name_product_image'] != "") {
                                                    echo BASE_URL . "public/uploads/products/" . $sanpham['name_product_image'];
                                                } else {
                                                    echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                } ?>" class="img-fluid hinhdaidien" />
                                </td>
                                <td><?= $sanpham['title_product'] ?></td>
                                <td>
                                    <?= $sanpham['od_soluong'] ?>
                                </td>
                                <td><?= number_format($sanpham['od_dongia'], 0) ?> vnđ</td>
                                <td><?= number_format($sanpham['od_soluong'] * $sanpham['od_dongia'], 0) ?> vnđ</td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <!-- content -->

    <!-- scripts -->
    <?php include_once('app/views/admin/layouts/scripts.php'); ?>
    <!-- end scripts -->
</body>

</html>