<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng | Lê Hồng Quốc Vương</title>

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
        <h1 class="text-center">Danh sách đơn hàng</h1>
        <div class="row">
            <div class="col col-md-12">
                <?php if ($_SESSION['kh_tendangnhap_logged'] != "") { ?>
                    <?php if (!empty($list_order)) { ?>
                        <table id="tblGioHang" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày lập</th>
                                    <th>Ngày giao</th>
                                    <th>Thanh toán</th>
                                    <th>Tổng tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="datarow">
                                <?php $stt = 1; ?>
                                <?php foreach ($list_order as $sanpham) { ?>
                                    <tr>
                                        <td><?php echo $stt;
                                            $stt += 1; ?></td>
                                        <td>
                                            <?= $sanpham['dh_ngaylap'] ?>
                                        </td>
                                        <td><?= $sanpham['dh_ngaygiao'] ?></td>
                                        <td>
                                            <?php if ($sanpham['dh_trangthaithanhtoan'] == 0) {
                                                echo "Chưa thanh toán";
                                            } else {
                                                echo "Đã thanh toán";
                                            }  ?>
                                        </td>
                                        <td><?= number_format($sanpham['dh_tongtien'], 0) ?> vnđ</td>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>order/show_order_detail/<?php echo $sanpham['dh_ma']; ?>" class="btn btn-xs btn-warning">
                                                <i alt="Info" class="fa fa-info-circle"> Chi tiết</i></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>


                    <?php } else { ?>
                        <h2>Bạn chưa đặt hàng!</h2>
                    <?php } ?>
                <?php } else {
                    echo '<div class="alert alert-danger mt-2" role="alert">Vui lòng Đăng nhập! <a href="' . BASE_URL . 'customer/show_login">Click vào đây để đến trang Đăng nhập</a></div>';
                } ?>



            </div>
        </div>
    </div>
    <!-- content -->

    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>


</body>

</html>