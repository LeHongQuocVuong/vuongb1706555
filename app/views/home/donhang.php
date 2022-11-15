<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng | Lê Hồng Quốc Vương</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once('app/views/home/layouts/styles.php'); ?>
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/app.css" type="text/css">

    <style>
        .hinhdaidien {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once('app/views/home/layouts/partials/header.php'); ?>
    <!-- end header -->

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
    <div class="container mt-4">
        <!-- Vùng ALERT hiển thị thông báo -->
        <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
            <div id="thongbao">&nbsp;</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <h1 class="text-center">Chi tiết đơn đặt hàng</h1>
        <?php if ($_SESSION['kh_tendangnhap_logged'] != "" || empty($customer)) { ?>
            <?php if (!empty($data_order)) { ?>
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
                                <tr>
                                    <th colspan="5" style="text-align: right;">Tổng tiền:</th>
                                    <td><?= number_format($order['dh_tongtien'], 0) . ' VNĐ'  ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            <?php } else { ?>
                <h2>Bạn chưa đặt hàng!</h2>
            <?php } ?>
        <?php } else {
            echo '<div class="alert alert-danger mt-2" role="alert">Vui lòng Đăng nhập! <a href="' . BASE_URL . 'customer/show_login">Click vào đây để đến trang Đăng nhập</a></div>';
        } ?>

    </div>
    <!-- content -->

    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>

    <script>
        $(document).ready(function() {
            function removeSanPhamVaoGioHang(id) {
                // Dữ liệu gởi
                var dulieugoi = {
                    id_product: id
                };

                // AJAX đến API xóa sản phẩm khỏi Giỏ hàng trong Session
                $.ajax({
                    url: '<?php echo BASE_URL . "order/delete_cart" ?>',
                    method: "POST",
                    dataType: 'json',
                    data: dulieugoi,
                    success: function(data) {
                        // Refresh lại trang
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#thongbao').html(htmlString);
                        // Hiện thông báo
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            };

            // Đăng ký sự kiện cho các nút đang sử dụng class .btn-delete-sanpham
            $('#tblGioHang').on('click', '.btn-delete-sanpham', function(event) {
                // debugger;
                event.preventDefault();
                var id = $(this).data('sp-ma');

                console.log(id);
                removeSanPhamVaoGioHang(id);
            });

            // Cập nhật số lượng trong Giỏ hảng
            function capnhatSanPhamTrongGioHang(id, soluong) {
                // Dữ liệu gởi
                var dulieugoi = {
                    id_product: id,
                    soluong: soluong
                };

                $.ajax({
                    url: '<?php echo BASE_URL . "order/update_cart" ?>',
                    method: "POST",
                    dataType: 'json',
                    data: dulieugoi,
                    success: function(data) {
                        // Refresh lại trang
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#thongbao').html(htmlString);
                        // Hiện thông báo
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            };
            $('#tblGioHang').on('click', '.btn-capnhat-soluong', function(event) {
                // debugger;
                event.preventDefault();
                var id = $(this).data('sp-ma');
                var soluongmoi = $('#soluong_' + id).val();
                capnhatSanPhamTrongGioHang(id, soluongmoi);
            });
        });
    </script>
</body>

</html>