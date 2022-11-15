<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lê Hồng Quốc Vương</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once('app/views/home/layouts/styles.php'); ?>
    <!-- CSS OwlCarousel -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/OwlCarousel/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/OwlCarousel/css/owl.theme.default.min.css" type="text/css">
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/views/home/assets/css/app.css" type="text/css">

    <style>
        .homepage-slider-img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once('app/views/home/layouts/partials/header.php'); ?>
    <!-- end header -->

    <!-- Slider -->
    <div class="container my-2">
        <div class="row">
            <div class="col-md-8" style="padding: unset;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/slider/banner1.png" class="d-block img-fluid slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/slider/banner2.png" class="d-block  img-fluid slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/slider/banner3.png" class="d-block  img-fluid slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/slider/banner4.png" class="d-block  img-fluid slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/slider/banner5.png" class="d-block  img-fluid slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/slider/banner6.png" class="d-block  img-fluid  slider" alt="...">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-md-4 homenew" style=" background-color: white;">
                <div class="row">
                    <div class="col-md-12 border-bottom mb-3">
                        <h2>
                            <a href="#">Bài viết</a>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" data-spy="scroll" style="height: 222px;overflow: auto;">
                        <a class="row mb-3 post-cate border-bottom" href="<?= BASE_URL . 'post/show_post_by_cate/1' ?>">
                            <div class="col-md-3" style="padding-right: 0px !important; text-align: center;">
                                <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/icon/icon_thu_thuat_van_phong.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h5>Thủ thuật văn phòng</h5>
                                <p>Các bài viết vè thủ thuật văn phòng</p>
                            </div>
                        </a>

                        <a class="row mb-3 post-cate border-bottom" href="<?= BASE_URL . 'post/show_post_by_cate/2' ?>">
                            <div class="col-md-3" style="padding-right: 0px !important; text-align: center;">
                                <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/icon/icon_may_tinh.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h5>Máy tính - Laptop - Tablet</h5>
                                <p>Các bài biết giới thiệu sản phẩm, tư vấn mua sắm</p>
                            </div>
                        </a>

                        <a class="row mb-3 post-cate border-bottom" href="<?= BASE_URL . 'post/show_post_by_cate/3' ?>">
                            <div class="col-md-3" style="padding-right: 0px !important; text-align: center;">
                                <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/icon/icon_mang_xa_hoi.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h5>Mạng xã hội</h5>
                                <p>Mẹo hay khi sử dụng mạng xã hội</p>
                            </div>
                        </a>

                        <a class="row mb-3 post-cate border-bottom" href="<?= BASE_URL . 'post/show_post_by_cate/4' ?>">
                            <div class="col-md-3" style="padding-right: 0px !important; text-align: center;">
                                <img src="<?php echo BASE_URL;  ?>app/views/home/assets/img/icon/icon_phu_kien_khac.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h5>Phụ kiện và các sản phẩm khác</h5>
                                <p>Các bài biết giới thiệu sản phẩm, tư vấn mua sắm</p>
                            </div>
                        </a>
                    </div>


                </div>

            </div>
        </div>
    </div>

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

    <!-- KHUYẾN MÃI HOT NHẤT -->
    <div class="container" style="background-color: white;">
        <div class="row NoiBat-Title">
            <div class="pt-2">
                <h5>KHUYẾN MÃI HOT NHẤT</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="slider">
                    <div class="owl-carousel owl-theme">

                        <?php foreach ($tablet as $datatab) : ?>
                            <div class="item item-carousel owl-product">
                                <a href="<?php echo BASE_URL . "product/show_product_detail_home/" . $datatab['id_product']; ?>">
                                    <!-- Nếu có hình sản phẩm thì hiển thị -->

                                    <img src="<?php if (isset($datatab['name_product_image']) && $datatab['name_product_image'] != "") {
                                                    echo $datatab['name_product_image'];
                                                } else {
                                                    echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                                    <h6><?= $datatab['title_product'] ?></h6>

                                    <div><strong style="color: red; "><?= $datatab['price_product'] ?></strong>
                                    </div>
                                    <div><small><del><?= $datatab['old_price_product'] ?></del></small></div>


                                </a>
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($laptop as $datatab) : ?>
                            <div class="item item-carousel owl-product">
                                <a href="<?php echo BASE_URL . "product/chitiet/" . $datatab['id_product']; ?>">
                                    <!-- Nếu có hình sản phẩm thì hiển thị -->

                                    <img src="<?php if (isset($datatab['name_product_image']) && $datatab['name_product_image'] != "") {
                                                    echo $datatab['name_product_image'];
                                                } else {
                                                    echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                                    <h6><?= $datatab['title_product'] ?></h6>

                                    <div><strong style="color: red; "><?= $datatab['price_product'] ?></strong>
                                    </div>
                                    <div><small><del><?= $datatab['old_price_product'] ?></del></small></div>


                                </a>
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($dienthoai as $datatab) : ?>
                            <div class="item item-carousel owl-product">
                                <a href="<?php echo BASE_URL . "product/chitiet/" . $datatab['id_product']; ?>">
                                    <!-- Nếu có hình sản phẩm thì hiển thị -->

                                    <img src="<?php if (isset($datatab['name_product_image']) && $datatab['name_product_image'] != "") {
                                                    echo $datatab['name_product_image'];
                                                } else {
                                                    echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                                    <h6><?= $datatab['title_product'] ?></h6>

                                    <div><strong style="color: red; "><?= $datatab['price_product'] ?></strong>
                                    </div>
                                    <div><small><del><?= $datatab['old_price_product'] ?></del></small></div>


                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- KHUYẾN MÃI HOT NHẤT -->

    <!-- Điện thoại nổi bật -->
    <div class="container NoiBat">

        <div class="row NoiBat-Title">
            <div class="col-md-4 pt-2">
                <h5>ĐIỆN THOẠI NỖI BẬT NHẤT</h5>
            </div>
            <div class="col-md-8 d-none d-md-block">
                <div class="row">
                    <div class="col-md-2 NoiBat-a">
                        <a href="<?php echo BASE_URL ?> category/show_product_category_home/3">Samsung Galaxy Mới</a>

                    </div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/3">Iphone Pro Max</a>
                    </div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/3">Iphone 11</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/3">Redmi Note</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/3">Oppo Reno 4</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/3">Xem tất cả</a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pl-0 a-product">
                <a href="">
                    <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/product/1_dt_NoiBat.jpg" alt="" style="width: 555px;" class="img-fluid">

                </a>
            </div>
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <div class="col-md-2 a-product">
                    <a href="<?php echo BASE_URL . "product/show_product_detail_home/" . $dienthoai[$i]['id_product'] ?>">
                        <!-- Nếu có hình sản phẩm thì hiển thị -->

                        <img src="<?php if (isset($dienthoai[$i]['name_product_image']) && $dienthoai[$i]['name_product_image'] != "") {
                                        echo $dienthoai[$i]['name_product_image'];
                                    } else {
                                        echo BASE_URL . "public/uploads/products/default-image_600.png";
                                    }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                        <h6><?= $dienthoai[$i]['title_product'] ?></h6>

                        <div><strong style="color: red; "><?= $dienthoai[$i]['price_product'] ?></strong>
                        </div>
                        <div><del><?= $dienthoai[$i]['old_price_product'] ?></del></div>

                        <label class="Tragop">Trả góp 0%</label>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
        <div class="row">
            <div class="col-md-6 pl-0 a-product">
                <a href="">
                    <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/product/1_dt_NoiBat2.jpg" alt="" style="width: 555px;" class="img-fluid">

                </a>
            </div>
            <?php for ($i = 3; $i < 6; $i++) : ?>
                <div class="col-md-2 a-product">
                    <a href="<?php echo BASE_URL . "product/show_product_detail_home/" . $dienthoai[$i]['id_product'] ?>">
                        <!-- Nếu có hình sản phẩm thì hiển thị -->

                        <img src="<?php if (isset($dienthoai[$i]['name_product_image']) && $dienthoai[$i]['name_product_image'] != "") {
                                        echo $dienthoai[$i]['name_product_image'];
                                    } else {
                                        echo BASE_URL . "public/uploads/products/default-image_600.png";
                                    }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                        <h6><?= $dienthoai[$i]['title_product'] ?></h6>

                        <div><strong style="color: red; "><?= $dienthoai[$i]['price_product'] ?></strong>
                        </div>
                        <div><del><?= $dienthoai[$i]['old_price_product'] ?></del></div>

                        <label class="Tragop">Trả góp 0%</label>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <!-- Điện thoại nổi bật -->

    <!-- Laptop nổi bật -->
    <div class="container NoiBat">

        <div class="row NoiBat-Title">
            <div class="col-md-4 pt-2">
                <h5>LAPTOP NỖI BẬT NHẤT</h5>
            </div>
            <div class="col-md-8 d-none d-md-block">
                <div class="row">
                    <div class="col-md-2 NoiBat-a">
                        <a href="<?php echo BASE_URL ?> category/show_product_category_home/2">Laptop Asus</a>

                    </div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/2">Laptop HP</a>
                    </div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/2">Macbool Pro</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/2">Laptop Dell</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/2">Laptop Acer</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/2">Xem tất cả</a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pl-0 a-product">
                <a href="">
                    <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/product/2_lt_NoiBat.jpg" alt="" style="width: 555px;" class="img-fluid">

                </a>
            </div>
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <div class="col-md-2 a-product">
                    <a href="<?php echo BASE_URL . "product/show_product_detail_home/" . $laptop[$i]['id_product'] ?>">
                        <!-- Nếu có hình sản phẩm thì hiển thị -->

                        <img src="<?php if (isset($laptop[$i]['name_product_image']) && $laptop[$i]['name_product_image'] != "") {
                                        echo $laptop[$i]['name_product_image'];
                                    } else {
                                        echo BASE_URL . "public/uploads/products/default-image_600.png";
                                    }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                        <h6><?= $laptop[$i]['title_product'] ?></h6>

                        <div><strong style="color: red; "><?= $laptop[$i]['price_product'] ?></strong>
                        </div>
                        <div><del><?= $laptop[$i]['old_price_product'] ?></del></div>

                        <label class="Tragop">Trả góp 0%</label>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <!-- Laptop nổi bật -->

    <!-- Tablet nổi bật -->
    <div class="container NoiBat">

        <div class="row NoiBat-Title">
            <div class="col-md-4 pt-2">
                <h5>TABLET NỖI BẬT NHẤT</h5>
            </div>
            <div class="col-md-8 d-none d-md-block">
                <div class="row">
                    <div class="col-md-2 NoiBat-a">
                        <a href="<?php echo BASE_URL ?> category/show_product_category_home/1">Samsung Galaxy Tab</a>

                    </div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/1">iPad</a>
                    </div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/1">Lenovo Tab</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/1">Masstel Tab</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/1">Huawei Tab</a></div>
                    <div class="col-md-2 pt-2 NoiBat-a"><a href="<?php echo BASE_URL ?> category/show_product_category_home/1">Xem tất cả</a></div>
                </div>
            </div>
        </div>
        <div class="row">

            <?php for ($i = 0; $i < 4; $i++) : ?>
                <div class="col-md-3 a-product">
                    <a href="<?php echo BASE_URL . "product/show_product_detail_home/" . $tablet[$i]['id_product'] ?>">
                        <!-- Nếu có hình sản phẩm thì hiển thị -->

                        <img src="<?php if (isset($tablet[$i]['name_product_image']) && $tablet[$i]['name_product_image'] != "") {
                                        echo $tablet[$i]['name_product_image'];
                                    } else {
                                        echo BASE_URL . "public/uploads/products/default-image_600.png";
                                    }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                        <h6><?= $tablet[$i]['title_product'] ?></h6>

                        <div><strong style="color: red; "><?= $tablet[$i]['price_product'] ?></strong>
                        </div>
                        <div><small><del><?= $tablet[$i]['old_price_product'] ?></del></small></div>

                        <label class="Tragop">Trả góp 0%</label>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <!-- Tablet nổi bật -->



    <!-- Back to top -->
    <button id="myBtn" title="Go to top"><i class="fa fa-caret-up" aria-hidden="true"></i></button>


    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>
    <!-- OwlCarousel -->
    <script src="<?php echo BASE_URL; ?>vendor/OwlCarousel/js/owl.carousel.min.js"></script>

    <!-- Custom script -->
    <script src="<?php echo BASE_URL;  ?>app/views/home/assets/js/app.js"></script>
</body>

</html>