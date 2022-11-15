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

    <style>
        a.row:hover {
            color: blue !important;
        }

        .img-post {
            width: 200px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100 bg-light">
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
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="accordion" id="accordionExample">
                    <?php foreach ($postofcate as $cate) { ?>
                        <div class="card">
                            <div class="card-header px-0" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left text-center" type="button" data-toggle="collapse" data-target="#collapse<?= $cate['id_post_category'] ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <a href="<?= BASE_URL . 'post/show_post_by_cate/' . $cate['id_post_category'] ?>"><?= $cate['title_post_category'] ?></a>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse<?= $cate['id_post_category'] ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <?php foreach ($cate['posts'] as $post) { ?>
                                        <a class="row border-bottom p-2" href="<?= BASE_URL . 'post/show_post/' . $post['id_post'] ?>"><?= $post['title_post'] ?> </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table table-hover table-border">
                    <tbody>
                        <?php foreach ($postbyPostCateId as $item) { ?>
                            <tr>
                                <td>
                                    <a href="<?= BASE_URL . 'post/show_post_home/' . $item['id_post'] ?>" class="row">
                                        <div class="col-md-4">
                                            <img src="<?php if (isset($item['image_name_post']) && $item['image_name_post'] != "") {
                                                            echo BASE_URL . 'public/uploads/posts/' . $item['image_name_post'];
                                                        } else {
                                                            echo BASE_URL . "public/uploads/products/default-image_600.png";
                                                        }  ?>" class="img-post">
                                        </div>
                                        <div class="col-md-8" style="align-items: center; display: flex;">
                                            <h4><?= $item['title_post'] ?></h4>
                                        </div>
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
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

</body>

</html>