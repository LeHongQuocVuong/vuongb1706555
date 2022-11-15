<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>login/dashboard">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Bài viết
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>post/add_post">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>post/list_post">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Danh mục bài viết
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>post_category/add_post_category">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>post_category/list_post_category">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Sản phẩm
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>product/add_product">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>product/list_product">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Danh mục sản phẩm
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>category/add_category_product">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>category/list_category_product">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Nhà sản xuất
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>product_producer/add_product_producer">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>product_producer/list_product_producer">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Đơn hàng
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>order_admin/add_order">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>order_admin/list_order">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Thanh toán
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>hinhthucthanhtoan/add_hinhthucthanhtoan">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>hinhthucthanhtoan/list_hinhthucthanhtoan">Liệt kê</a></li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>login/logout" role="button">
                        Đăng xuất
                    </a>

                </li>
            </ul>
        </div>
    </nav>
</div>