<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product[0]['title_category_product'] ?> | Lê Hồng Quốc Vương</title>

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

        .btn.is-checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .nsx {
            width: 200px;
            height: 48px;
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
    <!-- Hãng laptop -->
    <div class="container pt-2 filters text-center" style="background-color: white;">

        <div class="btn-group button-group flex-wrap flex-md-nowrap" role="group" aria-label="Basic example" data-filter-group="HDT">

            <button type="button" class="btn btn-outline-primary" data-type=".type1" title="Apple">
                <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/logo/Apple.jpg" class="img-fluid d-none d-sm-block" alt="">
                <div class="d-sm-none d-block">Apple</div>
            </button>


            <button type="button" class="btn btn-outline-primary" data-type=".type2" title="Samsung">
                <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/logo/Samsung.jpg" class="img-fluid d-none d-sm-block" alt="">
                <div class="d-sm-none d-block">Samsung</div>
            </button>


            <button type="button" class="btn btn-outline-primary" data-type=".type3" title="Realme">
                <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/logo/Realme.png" class="img-fluid d-none d-sm-block" alt="">
                <div class="d-sm-none d-block">Realme</div>
            </button>

            <button type="button" class="btn btn-primary is-checked" data-type=".all" title="Tất cả">
                Tất cả
            </button>



        </div>
        <!-- Mức giá -->

        <!-- <div class="row text-center pt-2" style="background-color: white;">
            <div class="col-md-2 text-md-right pt-1">Chọn mức giá:</div>

            <div class="col-md-6 pl-0">
                <div class="btn-group button-group" role="group" aria-label="Basic example" data-filter-group="Gia">
                    <button type="button" class="btn btn-primary btnGia btnGia0 is-checked" data-type=".btnGiaAll" title="Tất cả">
                        Tất cả
                    </button>
                    <button type="button" class="btn btn-primary btnGia btnGia1" data-type=".Duoi7" title="Dưới 7 triệu">
                        Dưới 7 triệu
                    </button>
                    <button type="button" class="btn btn-primary btnGia btnGia2" data-type=".7_13" title="Từ 7 triệu đến 13 triệu">
                        Từ 7 triệu đến 13 triệu
                    </button>
                    <button type="button" class="btn btn-primary btnGia btnGia3" data-type=".Tren13" title="Trên 13 triệu">
                        Trên 13 triệu
                    </button>


                </div>
            </div>

        </div> -->

        <!-- Điện thoai -->
        <div class="row row-cols-1 row-cols-md-4 bg-white IsoTope">
            <?php foreach ($product as $dienthoai) : ?>
                <div class="col-md-3 a-product border pb-3 all btnGiaAll
                        <?php if ($dienthoai['id_product_producer'] == 1) echo "type1 ";
                        elseif ($dienthoai['id_product_producer'] == 2) echo "type2 ";
                        elseif ($dienthoai['id_product_producer'] == 12) echo "type3 ";
                        elseif ($dienthoai['id_product_producer'] == 3) echo "type4 ";
                        elseif ($dienthoai['id_product_producer'] == 8) echo "type5 ";
                        if ($dienthoai['price_product'] < 7000000) echo "Duoi7";
                        elseif ($dienthoai['price_product'] < 13000000) echo "7_13";
                        else echo "Tren13";
                        ?>
                        ">
                    <a href="<?php echo BASE_URL . "product/show_product_detail_home/" . $dienthoai['id_product'] ?>">
                        <!-- Nếu có hình sản phẩm thì hiển thị -->

                        <img src="<?php if (isset($dienthoai['name_product_image']) && $dienthoai['name_product_image'] != "") {
                                        echo $dienthoai['name_product_image'];
                                    } else {
                                        echo BASE_URL . "public/uploads/products/default-image_600.png";
                                    }  ?>" alt="" class="img-carousel" style="width: 150px; height: 150;">

                        <h6><?= $dienthoai['title_product'] ?></h6>

                        <div><strong style="color: red; "><?= number_format($dienthoai['price_product'], 0) . " VNĐ" ?></strong>
                        </div>
                        <div><del><?= number_format($dienthoai['old_price_product'], 0) . " VNĐ" ?></del></div>

                        <label class="Tragop">Trả góp 0%</label>
                        <img src="<?php echo BASE_URL; ?>app/views/home/assets/img/icon/icon_BH.png" alt="" class="BaoHanh" style="left: 210px;">
                    </a>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
    <!-- content -->

    <!-- Back to top -->
    <button id="myBtn" title="Go to top"><i class="fa fa-caret-up" aria-hidden="true"></i></button>


    <!-- footer -->
    <?php include_once('app/views/home/layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once('app/views/home/layouts/scripts.php'); ?>
    <!-- OwlCarousel -->
    <script src="<?php echo BASE_URL; ?>vendor/OwlCarousel/js/owl.carousel.min.js"></script>
    <!-- Isotope -->
    <script src="<?php echo BASE_URL; ?>vendor/isotope/isotope.pkgd.min.js"></script>
    <!-- swiper -->
    <script src="<?php echo BASE_URL; ?>vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Custom script -->
    <script src="<?php echo BASE_URL;  ?>app/views/home/assets/js/app.js"></script>

    <script>
        var HDT = '';
        $(document).ready(function() {
            // Isotope__________________________

            var $grid = $('.IsoTope').isotope({
                itemSelector: '.a-product',
            });

            // store filter for each group
            var filters = {};

            $('.filters').on('click', '.btn', function(event) {
                var $button = $(event.currentTarget);
                // get group key
                var $buttonGroup = $button.parents('.button-group');
                var filterGroup = $buttonGroup.attr('data-filter-group');
                // set filter for group
                filters[filterGroup] = $button.attr('data-type');
                // combine filters
                var filterValue = concatValues(filters);
                // set filter for Isotope
                $grid.isotope({
                    filter: filterValue
                });
            });

            // flatten object by concatting values
            function concatValues(obj) {
                var value = '';
                for (var prop in obj) {
                    value += obj[prop];
                }
                return value;
            }

            // change is-checked class on buttons
            $('.button-group').each(function(i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'button', function(event) {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    var $button = $(event.currentTarget);
                    $button.addClass('is-checked');
                });
            });
        });
    </script>
</body>

</html>