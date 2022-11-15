<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once('app/views/home/layouts/styles.php'); ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/DangNhap.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/app.css" type="text/css">

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
        <div class="container-md p-md-4">
            <div class="row">
                <div class="col-md-4 d-none d-md-block d-lg-block bg-white p-md-5 border-right">
                    <div class="DangNhap_left">
                        <div class="row">
                            <h2>Đăng ký</h2>
                        </div>
                        <div class="row">
                            <p>Tạo tài khoản để theo dõi đơn hàng, lưu
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
                        <div class="col-md-12">
                            <form action="<?php echo BASE_URL  ?>customer/register" method="post" name="frmCreate" id="frmCreate">
                                <div class="form-group">
                                    <label for="kh_tendangnhap">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="kh_tendangnhap" name="kh_tendangnhap" placeholder="Tên đăng nhập" value="">
                                </div>
                                <div class="form-group">
                                    <label for="kh_matkhau">Mật khẩu</label>
                                    <input type="password" class="form-control" id="kh_matkhau" name="kh_matkhau" placeholder="Mật khẩu" value="">
                                </div>
                                <div class="form-group">
                                    <label for="kh_ten">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="kh_ten" name="kh_ten" placeholder="Tên khách hàng" value="">
                                </div>

                                <div class="form-group">
                                    <label>Giới tính</label><br />
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="kh_gioitinh" id="kh_gioitinh-1" class="custom-control-input" value="1" checked>
                                        <label class="custom-control-label" for="kh_gioitinh-1">Nam</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="kh_gioitinh" id="kh_gioitinh-2" class="custom-control-input" value="0">
                                        <label class="custom-control-label" for="kh_gioitinh-2">Nữ</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kh_diachi">Địa chỉ</label>
                                    <input type="text" class="form-control" id="kh_diachi" name="kh_diachi" placeholder="Địa chỉ" value="">
                                </div>
                                <div class="form-group">
                                    <label for="kh_dienthoai">Điện thoại</label>
                                    <input type="text" class="form-control" id="kh_dienthoai" name="kh_dienthoai" placeholder="Điện thoại" value="">
                                </div>

                                <div class="form-group">
                                    <label for="kh_email">Email</label>
                                    <input type="text" class="form-control" id="kh_email" name="kh_email" placeholder="Email" ?>
                                </div>

                                <div class="form-group">
                                    <label for="kh_ngaysinh">Ngày sinh</label>
                                    <input type="date" class="form-control" name="kh_ngaysinh" id="kh_ngaysinh">
                                </div>

                                <div class="form-group">
                                    <label for="kh_cccd">Căn cước công dân</label>
                                    <input type="text" class="form-control" id="kh_cccd" name="kh_cccd" placeholder="Căn cước công dân">
                                </div>

                                <div class="row py-2">
                                    <div class="col-md-12">
                                        <button name="btnDangky" class="btn btn-warning btn-block">
                                            Đăng ký
                                        </button>
                                    </div>
                                </div>


                            </form>
                        </div>
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



    <script src="<?php echo BASE_URL;  ?>vendor/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#frmCreate").validate({
                rules: {
                    kh_tendangnhap: {
                        required: true
                    },
                    kh_matkhau: {
                        required: true
                    },
                    kh_ten: {
                        required: true
                    },
                    kh_diachi: {
                        required: true
                    },
                    kh_dienthoai: {
                        required: true
                    },
                    kh_email: {
                        required: true
                    },
                    kh_ngaysinh: {
                        required: true
                    },
                    kh_cccd: {
                        required: true
                    },
                },
                messages: {
                    kh_tendangnhap: {
                        required: "Vui lòng nhập tên đăng nhập"
                    },
                    kh_matkhau: {
                        required: "Vui lòng nhập mật khẩu"
                    },
                    kh_ten: {
                        required: "Vui lòng nhập tên khách hàng"
                    },
                    kh_diachi: {
                        required: "Vui lòng nhập địa chỉ"
                    },
                    kh_dienthoai: {
                        required: "Vui lòng nhập số điện thoại"
                    },
                    kh_email: {
                        required: "Vui lòng nhập Email"
                    },
                    kh_ngaysinh: {
                        required: "Vui lòng nhập ngày sinh"
                    },
                    kh_cccd: {
                        required: "Vui lòng nhập Căn cước công dân"
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Thêm class `invalid-feedback` cho field đang có lỗi
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>

</body>

</html>