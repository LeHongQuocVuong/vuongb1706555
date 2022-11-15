<!-- Menu search -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 0px;">
    <div class="container">

        <a class="navbar-brand" href="<?php echo BASE_URL  ?>" style="color:#d4af37; font-weight: bold; font-size: 30px;">
            <img src="<?php echo BASE_URL  ?>app/views/home/assets/img/logo/logo1.png" alt="" style="width: 50px; height: 50px;">

            KING</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent_1" aria-controls="navbarSupportedContent_1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent_1">


            <form class="mx-auto" style="flex-basis: 500px;" method="post" action="<?php echo BASE_URL  ?>product/search">
                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                <div class="input-group">
                    <input type="text" name="timkiem" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" name="btnTimkiem" type="submit" id="button-addon2">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">


                <li class="nav-item pl-2">
                    <?php
                    // Đã đăng nhập rồi -> hiển thị tên Người dùng và menu Đăng xuất
                    if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
                    ?>
                <li class="nav-item text-nowrap">
                    <a class="nav-link">Chào <?= $_SESSION['kh_tendangnhap_logged']; ?></a>
                </li>
                <a class="btn btn-outline-secondary" href="<?php echo BASE_URL  ?>customer/logout">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Đăng xuất
                </a>
            <?php else : ?>
                <a class="btn btn-outline-secondary" href="<?php echo BASE_URL  ?>customer/show_login">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Đăng nhập
                </a>
            <?php endif; ?>
            <!-- <a class="btn btn-outline-secondary" href="DangNhap.php" role="button">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Đăng nhập
                            </a> -->
            </li>
            <li class="nav-item pl-2">
                <a class="btn btn-outline-secondary" href="<?php echo BASE_URL  ?>order/show_cart" role="button">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Giỏ hàng
                </a>
            </li>


            </ul>
        </div>
    </div>
</nav>


<!-- Menu  -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning" style="padding: 0px;">
    <div class="container">
        <a class="navbar-brand nav-a" href="<?php echo BASE_URL  ?>" title="Trang chủ">
            <b>
                <i class="fa fa-home" aria-hidden="true"></i>
                Trang chủ
            </b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <a class="nav-a" href="<?php echo BASE_URL  ?>product/showProductByCategory/3" title="Điện thoại di động, smartphone">
                <i class="fa fa-mobile fa-a" aria-hidden="true"></i>
                <b>Điện thoại</b>
            </a>
            <a class="nav-a" href="<?php echo BASE_URL  ?>product/showProductByCategory/2" title="Máy tính xách tay">
                <i class="fa fa-laptop" aria-hidden="true"></i>
                <b>Laptop</b>
            </a>
            <a class="nav-a" href="<?php echo BASE_URL  ?>product/showProductByCategory/1" title="Máy tính bảng">
                <i class="fa fa-tablet" aria-hidden="true"></i>
                <b>Tablet</b>
            </a>
            <a class="nav-a" href="<?php echo BASE_URL  ?>product/showProductByCategory/4" title="Phụ kiện điện thoại, laptop, Tablet">
                <i class="fa fa-headphones" aria-hidden="true"></i>
                <b>Phụ kiện</b>
            </a>
            <a class="nav-a" href="<?php echo BASE_URL  ?>product/showProductByCategory/8" title="smartwatch">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-smartwatch" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 5h.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H14V5z" />
                    <path fill-rule="evenodd" d="M8.5 4.5A.5.5 0 0 1 9 5v3.5a.5.5 0 0 1-.5.5H6a.5.5 0 0 1 0-1h2V5a.5.5 0 0 1 .5-.5z" />
                    <path fill-rule="evenodd" d="M4.5 2h7A2.5 2.5 0 0 1 14 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 11.5v-7A2.5 2.5 0 0 1 4.5 2zm0 1A1.5 1.5 0 0 0 3 4.5v7A1.5 1.5 0 0 0 4.5 13h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 11.5 3h-7z" />
                    <path d="M4 2.05v-.383C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v.383a2.512 2.512 0 0 0-.5-.05h-7c-.171 0-.338.017-.5.05zm0 11.9c.162.033.329.05.5.05h7c.171 0 .338-.017.5-.05v.383c0 .92-.746 1.667-1.667 1.667H5.667C4.747 16 4 15.254 4 14.333v-.383z" />
                </svg>
                <b>Đồng hồ thông minh</b>
            </a>
            <?php if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) {
            ?>
                <a class="nav-a" href="<?php echo BASE_URL  ?>order/list_order" title="Phụ kiện điện thoại, laptop, Tablet">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    <b>Đơn hàng</b>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>