<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lê Hồng Quốc Vương</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once('app/views/home/layouts/styles.php'); ?>
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/app.css" type="text/css">


    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/sweetalert2/sweetalert2.min.css">

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
        <h1 class="text-center">Giỏ hàng</h1>
        <div class="row">
            <div class="col col-md-12">
                <?php if (!empty($giohangdata)) { ?>
                    <table id="tblGioHang" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh đại diện</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="datarow">
                            <?php $stt = 1; ?>
                            <?php foreach ($giohangdata as $sanpham) : ?>
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
                                        <input type="number" class="form-control" id="soluong_<?= $sanpham['id_product'] ?>" name="soluong" value="<?= $sanpham['soluong'] ?>" />
                                        <button class="btn btn-primary btn-sm btn-capnhat-soluong" data-sp-ma="<?= $sanpham['id_product'] ?>">Cập nhật</button>
                                    </td>
                                    <td><?= number_format($sanpham['price_product'], 0) ?> vnđ</td>
                                    <td><?= number_format($sanpham['soluong'] * $sanpham['price_product'], 0) ?> vnđ</td>
                                    <td>
                                        <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `id_product` -->
                                        <a id="delete_<?= $stt ?>" data-sp-ma="<?= $sanpham['id_product'] ?>" class="btn btn-danger btn-delete-sanpham">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" style="text-align: right;">Tổng tiền:</td>
                                <td colspan="5"><?= number_format($tongtiengiohang, 0) ?> vnđ</td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                    if (!isset($_SESSION['kh_tendangnhap_logged']) || empty($_SESSION['kh_tendangnhap_logged'])) {

                        echo '<div class="alert alert-danger mt-2" role="alert">Vui lòng Đăng nhập trước khi Thanh toán! <a href="' . BASE_URL . 'customer/show_login">Click vào đây để đến trang Đăng nhập</a></div>';
                    } else {
                        // Nếu giỏ hàng trong session rỗng, return
                        if (!isset($_SESSION['giohangdata']) || empty($_SESSION['giohangdata'])) {
                            echo '<div class="alert alert-danger mt-2" role="alert">Giỏ hàng rỗng. Vui lòng chọn Sản phẩm trước khi Thanh toán!</div>';
                        } else { ?>
                            <h3>Thông tin thanh toán</h3>
                            <form id="frCheckout" action="<?= BASE_URL ?>order/checkout" method="post">
                                <input type="hidden" name="dh_tongtien" value="<?= $tongtiengiohang ?>">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="dh_noigiao">Địa chỉ giao hàng</label>
                                        <input require type="text" class="form-control" id="dh_noigiao" name="dh_noigiao" placeholder="Địa chỉ giao hàng">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="httt_ma">Hình thức thanh toán</label>
                                        <select name="httt_ma" class="custom-select">
                                            <?php foreach ($hinhthucthanhtoan as $key => $value) { ?>
                                                <option value="<?php echo $value['httt_ma']; ?>"><?php echo $value['httt_ten']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="btn-thanhtoan" type="submit" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thanh toán</button>
                                    </div>
                                </div>
                            </form>

                    <?php }
                    }
                    ?>

                <?php } else { ?>
                    <h2>Giỏ hàng rỗng!!!</h2>
                <?php } ?>
                <a href="<?php echo BASE_URL ?>" class="btn btn-warning btn-md mt-3"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay
                    về trang chủ</a>


            </div>
        </div>
    </div>
    <!-- content -->

    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>

    <script src="<?php echo BASE_URL; ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

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


            //Sweetalert khi bấm thanh toán
            $("#frCheckout").on('submit', function(e) {
                // e.preventDefault();
                Swal.fire({
                    title: 'Đơn đặt hàng đang được xử lý',
                    imageUrl: "<?= BASE_URL . 'public/loading.gif'  ?>",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            });
        });
    </script>
</body>

</html>