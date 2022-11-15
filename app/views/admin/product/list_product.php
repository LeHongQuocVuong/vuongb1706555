<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <!-- css -->
    <?php include_once('app/views/admin/layouts/styles.php'); ?>
    <!-- end css -->
</head>

<body>

    <!-- menu -->
    <?php include_once('app/views/admin/menu.php'); ?>
    <!-- end menu -->


    <!-- content -->
    <div class="row">
        <div class="col-md-12 bg-light">
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
            }
            ?>
            <h2 class="my-2" style="text-align: center;">Danh sách Sản phẩm</h2>

            <p><a href="<?php echo BASE_URL; ?>product/add_product" class="btn btn-xs btn-primary">
                    <i alt="Edit" class="fa fa-pencil"> Thêm</i></a>
            </p>
            <!-- datatables -->
            <table id="datatables" style="text-align: center;" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Loại</th>
                        <th>Nhà sản xuất</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 0;
                    foreach ($product as $key => $value) {
                        $stt++; ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $value['title_product']; ?></td>
                            <td><img src="<?php if (isset($value['name_product_image']) && $value['name_product_image'] != "") {
                                                echo $value['name_product_image'];
                                            } else {
                                                echo BASE_URL . "public/uploads/products/default-image_600.png";
                                            }  ?>" style="width: 100px;"></td>
                            <td><?php echo $value['price_product']; ?></td>
                            <td><?php echo $value['title_category_product']; ?></td>
                            <td><?php echo $value['title_product_producer']; ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>product/show_product_detail/<?php echo $value['id_product']; ?>" class="btn btn-xs btn-warning">
                                    <i alt="Info" class="fa fa-info-circle"> Chi tiết</i></a>
                                <a href="<?php echo BASE_URL; ?>product/show_update_product/<?php echo $value['id_product']; ?>" class="btn btn-xs btn-warning">
                                    <i alt="Edit" class="fa fa-pencil"> Sửa</i></a>

                                <button data-idCategoryProduct="<?php echo $value['id_product']; ?>" data-url="<?php echo BASE_URL; ?>product/delete_product/<?php echo $value['id_product']; ?>" class="btn btn-xs btn-danger btn-delete-CategoryProduct">
                                    <i alt="Delete" class="fa fa-trash"> Xoá</i></button>

                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
            <!-- datatables -->
        </div>
    </div>
    <!-- content -->

    <!-- scripts -->
    <?php include_once('app/views/admin/layouts/scripts.php'); ?>
    <!-- end scripts -->

    <script>
        $(document).ready(function() {
            // datatables
            var datatables = $("#datatables");
            if (typeof(datatables) != "undefined" && datatables !== null) {
                datatables.DataTable({
                    "oLanguage": {
                        "sUrl": "<?php echo BASE_URL; ?>vendor/datatables/vi.json"
                    }
                });
            }
            // datatables

            //Click button Delete
            var btn_delete_CategoryProduct = $(".btn-delete-CategoryProduct");
            btn_delete_CategoryProduct.on("click", function(e) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-danger mx-2'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Bạn có chắc muốn xoá không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Huỷ',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                                url: $(this).data('url'),
                                type: 'GET'
                            })
                            .done(function(response) {
                                Swal.fire({
                                    title: 'Đã xoá!',
                                    icon: 'success'
                                }).then(function() {
                                    location.reload();
                                })
                            })
                            .fail(function() {
                                Swal.fire({
                                    title: 'Đã xảy ra lỗi',
                                    icon: 'error'
                                })
                            });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: 'Đã huỷ',
                            icon: 'error'
                        })
                    }
                })

            });
            //Click button Delete

        });
    </script>
</body>

</html>