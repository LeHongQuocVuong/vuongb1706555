<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['title_product'] ?> | Lê Hồng Quốc Vương</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once('app/views/home/layouts/styles.php'); ?>
    <!-- CSS OwlCarousel -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/OwlCarousel/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/OwlCarousel/css/owl.theme.default.min.css" type="text/css">
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/app.css" type="text/css">

    <style>
        .Tragop {
            display: inline-block;
            margin-left: 10px;
            background-color: tomato;
            border-radius: 4px 4px 4px 4px;
            -moz-border-radius: 4px 4px 4px 4px;
            -webkit-border-radius: 4px 4px 4px 4px;
            border: 0px solid #000000;
        }

        .KhuyenMai_DichVu {
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .zoom_anh {
            width: 300px;
            height: 500px;
            margin: 0 15px;
            position: relative;
            overflow: hidden;
        }

        .img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-position: center;
            /* background-size: cover; */
            background-size: contain;
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

    <!-- Chi tiết sản phẩm -->

    <div class="container" style="background-color: white;">
        <!-- Vùng ALERT hiển thị thông báo -->
        <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
            <div id="thongbao">&nbsp;</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row py-2 border-bottom">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-8">
                        <h3>
                            <?= $product['title_category_product'] . ' ' . $product['title_product'] ?>
                        </h3>
                    </div>
                    <div class="col-md-2 d-none d-md-block pt-2" style="color: gold;">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                    <div class="col-md-2 d-none d-md-block pt-2" style="color: aqua;">
                        30 Đánh giá
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-none d-md-block text-right pt-1">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    Like
                </button>
                <button type="button" class="btn btn-primary btn-sm">
                    Share
                </button>
            </div>

        </div>
        <div class="row py-4">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="zoom_anh" data-image="<?php if (isset($product['name_product_image']) && $product['name_product_image'] != "") {
                                                                echo $product['name_product_image'];
                                                            } else {
                                                                echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                            }  ?>"></div>
                        <!-- <img :src="dt[0].hinhanh" class="img-fluid item" alt=""> -->
                        <p class="text-black-50 text-center pt-2">Hình ảnh sản phẩm</p>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post" action="">

                    <input type="hidden" name="id_product" id="id_product" value="<?= $product['id_product'] ?>" />
                    <input type="hidden" name="title_product" id="title_product" value="<?= $product['title_product'] ?>" />
                    <input type="hidden" name="price_product" id="price_product" value="<?= $product['price_product'] ?>" />
                    <input type="hidden" name="name_image" id="name_image" value="<?php if (isset($product['name_image']) && $product['name_image'] != "") {
                                                                                        echo $product['name_image'];
                                                                                    }  ?>" />

                    <div class=" row">

                        <h4 class="price">Giá hiện tại: <span style="color:red"><?= number_format($product['price_product'], 0) . " VNĐ" ?></span></h4>
                        <small class="text-muted">Giá cũ: <s><span><?= number_format($product['old_price_product'], 0) . " VNĐ" ?></span></s></small>

                        <div class="form-group row m-auto pt-2">
                            <label for="soluong">Số lượng đặt mua:</label>
                            <input type="number" class="form-control" id="soluong" name="soluong" value="1" min=1>
                        </div>
                        <div class="action row m-auto py-2">
                            <button class="add-to-cart btn btn-primary" id="btnThemVaoGioHang">Thêm vào giỏ hàng</button>
                            <button class="like btn btn-success" href="#"><span class="fa fa-heart"></span></button>
                        </div>
                    </div>


                </form>

            </div>
            <!-- Thông số kỹ thuật -->
            <div class="col-md-4 px-4">
                <div class="row border-bottom">
                    <div class="col-md-12">
                        <h5>
                            Thông số kỹ thuật
                        </h5>
                    </div>
                </div>
                <?php if (isset($product['display_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            Màn hình:
                        </div>
                        <div class="col-md-8">
                            <?= $product['display_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['os_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            Hệ điều hành:
                        </div>
                        <div class="col-md-8">
                            <?= $product['os_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['main_camera_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            Camera sau:
                        </div>
                        <div class="col-md-8">
                            <?= $product['main_camera_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['selfie_camera_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            Camera trước:
                        </div>
                        <div class="col-md-8">
                            <?= $product['selfie_camera_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['cpu_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            CPU:
                        </div>
                        <div class="col-md-8">
                            <?= $product['cpu_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['ram_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            RAM:
                        </div>
                        <div class="col-md-8">
                            <?= $product['ram_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['rom_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            Ổ cứng:
                        </div>
                        <div class="col-md-8">
                            <?= $product['rom_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($product['battery_product_detail'])) : ?>
                    <div class="row border-bottom">
                        <div class="col-md-4 text-black-50">
                            Pin:
                        </div>
                        <div class="col-md-8">
                            <?= $product['battery_product_detail']; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>


    </div>

    <!-- Hết chi tiết sản phẩm  -->

    <!-- Back to top -->
    <button id="myBtn" title="Go to top"><i class="fa fa-caret-up" aria-hidden="true"></i></button>


    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>
    <!-- Custom script -->
    <script src="<?php echo BASE_URL;  ?>app/views/home/assets/js/app.js"></script>

    <script>
        function addSanPhamVaoGioHang() {
            // Chuẩn bị dữ liệu gởi
            var dulieugoi = {
                id_product: $('#id_product').val(),
                title_product: $('#title_product').val(),
                price_product: $('#price_product').val(),
                name_image: $('#name_image').val(),
                soluong: $('#soluong').val(),
            };
            // console.log((dulieugoi));

            $.ajax({
                url: '<?php echo BASE_URL;  ?>order/add_cart',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    // console.log(data);
                    var htmlString =
                        `Sản phẩm đã được thêm vào Giỏ hàng. <a href="<?php echo BASE_URL . "order/show_cart"; ?>">Xem Giỏ hàng</a>.`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // console.log(textStatus, errorThrown);
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
        };

        // Đăng ký sự kiện cho nút Thêm vào giỏ hàng
        $('#btnThemVaoGioHang').click(function(event) {
            event.preventDefault();
            addSanPhamVaoGioHang();
        });

        // Zoom ảnh
        $(function() {
            var zoom = function(elm) {
                elm
                    .on('mouseover', function() {
                        $(this).children('.img').css({
                            'transform': 'scale(2)'
                        });
                    })
                    .on('mouseout', function() {
                        $(this).children('.img').css({
                            'transform': 'scale(1)'
                        });
                    })
                    .on('mousemove', function(e) {
                        $(this).children('.img').css({
                            'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
                        });
                    })
            }

            $('.zoom_anh').each(function() {
                $(this)
                    .append('<div class="img"></div>')
                    .children('.img').css({
                        'background-image': 'url(' + $(this).data('image') + ')'
                    });
                zoom($(this));
            })
        })
    </script>

</body>

</html>