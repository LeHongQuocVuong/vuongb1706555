<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhà sản xuất</title>


    <!-- css -->
    <?php include_once('app/views/admin/layouts/styles.php'); ?>
    <!-- end css -->
</head>

<body>
    <!-- menu -->
    <?php include_once('app/views/admin/menu.php'); ?>
    <!-- end menu -->

    <!-- content -->
    <div class="container">
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
                <h2 class="my-2" style="text-align: center;">Danh sách Nhà sản xuất</h2>

                <p><a href="<?php echo BASE_URL; ?>product_producer/add_product_producer" class="btn btn-xs btn-primary">
                        <i alt="Edit" class="fa fa-pencil"> Thêm</i></a>
                </p>
                <!-- datatables -->
                <table id="datatables" style="text-align: center;" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 0;
                        foreach ($product_producer as $key => $value) {
                            $stt++; ?>
                            <tr>
                                <td><?php echo $stt; ?></td>
                                <td><?php echo $value['title_product_producer']; ?></td>
                                <td><?php echo $value['desc_product_producer']; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>product_producer/show_update_product_producer/<?php echo $value['id_product_producer']; ?>" class="btn btn-xs btn-warning">
                                        <i alt="Edit" class="fa fa-pencil"> Sửa</i></a>

                                    <button data-idCategoryProduct="<?php echo $value['id_product_producer']; ?>" data-url="<?php echo BASE_URL; ?>product_producer/delete_product_producer/<?php echo $value['id_product_producer']; ?>" class="btn btn-xs btn-danger btn-delete-CategoryProduct">
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

            // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
            var preview_img_container = $(".preview-img-container");
            if (typeof(preview_img_container) != "undefined" && preview_img_container !== null) {
                const reader = new FileReader();
                const fileInput = document.getElementById("name_product_image");
                const img = document.getElementById("preview-img");
                reader.onload = e => {
                    img.src = e.target.result;
                }

                if (typeof(fileInput) != "undefined" && fileInput !== null) {
                    fileInput.addEventListener('change', e => {
                        const f = e.target.files[0];
                        reader.readAsDataURL(f);
                    })
                }
            }



        });
    </script>
</body>

</html>