<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhâp</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once('app/views/home/layouts/styles.php'); ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/DangNhap.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/app.css" type="text/css">

    <style>

    </style>
</head>

<body>
    <!-- header -->
    <?php include_once('app/views/home/layouts/partials/header.php'); ?>
    <!-- end header -->
    <?php
    // Đã đăng nhập rồi -> điều hướng về trang chủ
    if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) {
    ?>
        <h2>Bạn đã đăng nhập rồi. <a href="<?php echo BASE_URL; ?>">Bấm vào đây để quay về trang chủ.</a></h2>
    <?php } else { ?>
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
        <!-- Đăng nhập -->
        <div class="container-md p-md-4">
            <div class="row">
                <div class="col-md-4 d-none d-md-block d-lg-block bg-white p-md-5 border-right">
                    <div class="DangNhap_left">
                        <div class="row">
                            <h2>Đăng nhập</h2>
                        </div>
                        <div class="row">
                            <p>Đăng nhập để theo dõi đơn hàng, lưu
                                danh sách sản phẩm yêu thích, nhận
                                nhiều ưu đãi hấp dẫn.</p>
                        </div>
                        <div class="row">
                            <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/icon/DangNhap.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 bg-white p-md-5">
                    <div class="row">
                        <form action="<?php echo BASE_URL  ?>customer/authentication_login" method="post" name="frmLogin" id="frmLogin">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="kh_tendangnhap">Tên đăng nhập</label>
                                </div>
                                <div class="col-md-8">

                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Tên đăng nhập" name="kh_tendangnhap" id="kh_tendangnhap" required autofocus title="Vui lòng nhập Tên đăng nhập">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="pass">Password</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" id="kh_matkhau" name="kh_matkhau" placeholder="Mật khẩu" required title="Vui lòng nhập mật khẩu">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <a href="<?php echo BASE_URL  ?>customer/show_register" class="text-primary">Đăng ký</a>
                                        </div>
                                    </div>

                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <button type="submit" name="btnDangNhap" class="btn btn-warning btn-block">
                                                Đăng nhập</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- Back to top -->
        <button id="myBtn" title="Go to top"><i class="fa fa-caret-up" aria-hidden="true"></i></button>
    <?php } ?>

    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>
    <!-- Custom script -->
    <script src="<?php echo BASE_URL;  ?>app/views/home/assets/js/app.js"></script>


</body>

</html>