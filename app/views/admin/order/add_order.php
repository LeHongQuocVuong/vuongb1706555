<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hoá đơn</title>
    <!-- css -->
    <?php include_once('app/views/admin/layouts/styles.php'); ?>
    <!-- end css -->
</head>

<body>

    <!-- menu -->
    <?php include_once('app/views/admin/menu.php'); ?>
    <!-- end menu -->


    <!-- content -->
    <div class="container bg-light">
        <!-- Thong bao -->
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
        <!-- Thong bao -->
        <h2 class="my-2" style="text-align: center;">Thêm Đơn đặt hàng</h2>
        <form action="<?php echo BASE_URL; ?>order_admin/insert_order_admin" method="POST" class="my-2">
            <h4>Thông tin Đơn hàng</h4>
            <div id="donHangContainer">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Khách hàng</label>
                            <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                <option value="">Vui lòng chọn Khách hàng</option>
                                <?php foreach ($customer as $khachhang) { ?>
                                    <option value="<?= $khachhang['kh_tendangnhap'] ?>"><?= $khachhang['kh_tomtat'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Ngày lập</label>
                            <input type="datetime-local" name="dh_ngaylap" id="dh_ngaylap" class="form-control" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Ngày giao</label>
                            <input type="datetime-local" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nơi giao</label>
                            <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Trạng thái thanh toán</label><br />
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
                                <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Hình thức thanh toán</label>
                            <select name="httt_ma" id="httt_ma" class="form-control">
                                <?php foreach ($hinhthucthanhtoan as $httt) { ?>
                                    <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <h4>Chi tiết Đơn hàng</h4>
            <div id="chiTietDonHangContainer">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="id_product">Sản phẩm</label>
                            <select class="form-control" id="id_product" name="id_product">
                                <?php foreach ($product as $sanpham) : ?>
                                    <option value="<?= $sanpham['id_product'] ?>" data-price_product="<?= $sanpham['price_product'] ?>"><?= $sanpham['id_product'] . ' - ' . $sanpham['title_product'] . ' - ' . number_format($sanpham['price_product'], 0) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input value="1" type="number" min="1" name="soluong" id="soluong" class="form-control" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Xử lý</label><br />
                            <button type="button" id="btnThemSanPham" class="btn btn-secondary">Thêm vào đơn hàng</button>
                        </div>
                    </div>
                </div>
                <table id="tblChiTietDonHang" class="table table-bordered">
                    <input type="hidden" id="dh_tongtien" name="dh_tongtien" value="0" />
                    <thead>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Tổng tiền:</td>
                            <td colspan="2" id="td_dh_tongtien">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
    <!-- content -->

    <!-- scripts -->
    <?php include_once('app/views/admin/layouts/scripts.php'); ?>
    <!-- end scripts -->

    <script>
        $(document).ready(function() {
            var dh_tongtien = 0;
            // Đăng ký sự kiện Click nút Thêm Sản phẩm
            $('#btnThemSanPham').click(function() {
                // debugger;
                // Lấy thông tin Sản phẩm
                var id_product = $('#id_product').val();
                var price_product = $('#id_product option:selected').data('price_product');
                var title_product = $('#id_product option:selected').text();
                var soluong = $('#soluong').val();
                var thanhtien = (soluong * price_product);
                dh_tongtien += thanhtien;
                $('#td_dh_tongtien').text(dh_tongtien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $('#dh_tongtien').val(dh_tongtien);

                // Tạo mẫu giao diện HTML Table Row
                if (id_product != '' && soluong > 0) {
                    var htmlTemplate = '<tr>';
                    htmlTemplate += '<input type="hidden" id="ip_id_product-' + id_product + '" name="id_product[]" value="' + id_product + '"/>';
                    // htmlTemplate += '<input type="hidden" name="od_soluong[]" value="' + soluong + '"/>';
                    htmlTemplate += '<input type="hidden"id="ip_od_dongia-' + id_product + '" name="od_dongia[]" value="' + price_product + '"/>';
                    htmlTemplate += '<input type="hidden"id="ip_thanhtien-' + id_product + '" value="' + thanhtien + '"/>';
                    htmlTemplate += '<td>' + title_product + '</td>';
                    // htmlTemplate += '<td>' + soluong + '</td>';
                    htmlTemplate += `<td class="input-group">
                                        <input name="od_soluong[]" id="ip_od_soluong-` + id_product + `" value="` + soluong + `" type="number" min="1" class="form-control"/>
                                        <button data-id="` + id_product + `"  class="btn-update btn btn-primary" type="button">Sửa</button>    
                                    </td>`;
                    htmlTemplate += '<td id="price_product-' + id_product + '">' + price_product.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + '</td>';
                    htmlTemplate += '<td id="thanhtien-' + id_product + '" >' + thanhtien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + '</td>';
                    htmlTemplate += '<td><button id="btnDelete-' + id_product + '" data-id="' + id_product + '" type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
                    htmlTemplate += '</tr>';

                    // Thêm vào TABLE BODY
                    $('#tblChiTietDonHang tbody').append(htmlTemplate);
                } else alert("chọn sản phẩm");

                // Clear
                $('#id_product').val('');
                $('#soluong').val(1);
            });

            // Đăng ký sự kiện cho tất cả các nút XÓA có sử dụng class .btn-delete-row
            $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
                // Ta có cấu trúc
                // <tr>
                //    <td>
                //        <button class="btn-delete-row"></button>     <--- $(this) chính là đối tượng đang được người dùng click
                //    </td>
                // </tr>

                // Từ nút người dùng click -> tìm lên phần tử cha -> phần tử cha
                // Xóa dòng TR
                id_product = $(this).data('id');
                thanhtienCu = $('#ip_thanhtien-' + id_product).val();
                dh_tongtien -= thanhtienCu;
                $('#td_dh_tongtien').text(dh_tongtien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $('#dh_tongtien').val(dh_tongtien);
                $(this).parent().parent()[0].remove();
            });

            // Đăng ký sự kiện cho tất cả các nút  có sử dụng class btn-update
            $('#chiTietDonHangContainer').on('click', '.btn-update', function() {
                // Ta có cấu trúc
                // <tr>
                //    <td>
                //        <input>
                //        <button class="btn-update"></button>     <--- $(this) chính là đối tượng đang được người dùng click
                //    </td>
                // </tr>

                // Từ nút người dùng click -> tìm lên phần tử cha -> phần tử cha
                // Update dòng TR
                var id_product = $(this).data('id');
                thanhtienCu = $('#ip_thanhtien-' + id_product).val();
                var soluong = $('#ip_od_soluong-' + id_product).val();
                var dongia = $('#ip_od_dongia-' + id_product).val();
                var thanhtienMoi = soluong * dongia;
                dh_tongtien = dh_tongtien - thanhtienCu + thanhtienMoi;
                $('#td_dh_tongtien').text(dh_tongtien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $('#dh_tongtien').val(dh_tongtien);
                $('#ip_thanhtien-' + id_product).val(thanhtienMoi);
            });
        });
    </script>

</body>

</html>