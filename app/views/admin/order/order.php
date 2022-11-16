<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
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
            <h2 class="my-2" style="text-align: center;">Danh sách Đơn đặt hàng</h2>

            <p><a href="<?php echo BASE_URL; ?>order_admin/add_order" class="btn btn-xs btn-primary">
                    <i alt="Edit" class="fa fa-pencil"> Thêm</i></a>
            </p>
            <!-- datatables -->
            <table id="datatables" style="text-align: center;" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Khách hàng</th>
                        <th>Ngày lập</th>
                        <th>Ngày giao</th>
                        <th>Nơi giao</th>
                        <th>HTTT</th>
                        <th>Tổng thành tiền</th>
                        <th>TTTT</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_order as $dondathang) : ?>
                        <tr>
                            <td><?= $dondathang['dh_ma'] ?></td>
                            <td><b><?= $dondathang['kh_ten'] ?></b><br />(<?= $dondathang['kh_dienthoai'] ?>)</td>
                            <td><?= $dondathang['dh_ngaylap'] ?></td>
                            <td><?= $dondathang['dh_ngaygiao'] ?></td>
                            <td><?= $dondathang['dh_noigiao'] ?></td>
                            <td><span class="badge badge-primary"><?= $dondathang['httt_ten'] ?></span></td>
                            <td><?= number_format($dondathang['dh_tongtien'], 0) . " VNĐ" ?></td>
                            <td>
                                <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                    <span class="badge badge-danger">Chưa xử lý</span>
                                <?php else : ?>
                                    <span class="badge badge-success">Đã giao hàng</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                                    <a href="<?= BASE_URL . 'order_admin/show_edit_order/' . $dondathang['dh_ma'] ?>" class="btn btn-warning">
                                        Sửa
                                    </a>
                                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                    <button data-idCategoryProduct="<?php echo $dondathang['dh_ma']; ?>" data-url="<?php echo BASE_URL; ?>order_admin/delete_order/<?php echo $dondathang['dh_ma']; ?>" class="btn btn-xs btn-danger btn-delete-CategoryProduct">
                                        <i alt="Delete" class="fa fa-trash"> Xoá</i></button>
                                    <a href="<?php echo BASE_URL; ?>order_admin/show_order_detail/<?php echo $dondathang['dh_ma']; ?>" class="btn btn-xs btn-warning">
                                        <i alt="Info" class="fa fa-info-circle"> Chi tiết</i></a>
                                <?php else : ?>
                                    <!-- Đơn hàng nào đã thanh toán rồi thì không cho phép Xóa, Sửa -->
                                    <a href="<?php echo BASE_URL; ?>order_admin/show_order_detail/<?php echo $dondathang['dh_ma']; ?>" class="btn btn-xs btn-warning">
                                        <i alt="Info" class="fa fa-info-circle"> Chi tiết</i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

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