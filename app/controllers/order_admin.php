<?php
class order_admin extends dController
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->list_order();
    }

    public function list_order()
    {

        // Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào

        //Danh sach don hang
        $orderModel = $this->load->model('orderModel');
        $table_order = 'order';
        $result_order = $orderModel->order($table_order);
        if ($result_order[0]['kh_tendangnhap'] != "") {

            $result_data['list_order'] = $result_order;
            $this->load->view('admin/order/order', $result_data);
            // $this->load->view('admin/footer');
        } else {
            $error = "Chưa có đơn đặt hàng";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "admin/order");
        }
    }

    public function add_order()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        //lấy hinhthucthanhtoan
        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');
        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';
        $data['hinhthucthanhtoan'] = $hinhthucthanhtoanModel->hinhthucthanhtoan($table_hinhthucthanhtoan);

        //get customer
        $customerModel = $this->load->model('customerModel');
        $table_customer = 'customer';
        $result_customer = $customerModel->customer($table_customer);
        $data['customer'] = [];
        foreach ($result_customer as $customer) {
            $tomtat = 'Họ tên: ' . $customer['kh_ten'] . ", số điện thoại: " . $customer['kh_dienthoai'];

            $data['customer'][] = array(
                'kh_tendangnhap' => $customer['kh_tendangnhap'],
                'kh_tomtat' => $tomtat
            );
        }

        //get product
        $productModel = $this->load->model('productModel');
        $table_product = 'product';
        $data['product'] = $productModel->getProductNormal($table_product);

        $this->load->view('admin/order/add_order', $data);
    }

    public function insert_order_admin()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        if (isset($_POST['kh_tendangnhap']) && isset($_POST['id_product']) && isset($_POST['od_soluong']) && isset($_POST['od_dongia'])) {
            $kh_tendangnhap = $_POST['kh_tendangnhap'];

            $customerModel = $this->load->model('customerModel');
            $table_customer = 'customer';
            $result_customer = $customerModel->customerbyUsername($table_customer, $kh_tendangnhap);

            if (isset($result_customer[0]['kh_tendangnhap'])) {
                // Thông tin đơn hàng
                $dh_ngaylap = $_POST['dh_ngaylap'];
                $dh_ngaygiao = $_POST['dh_ngaygiao'];
                $dh_noigiao = $_POST['dh_noigiao'];
                $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                $dh_tongtien = $_POST['dh_tongtien'];
                $httt_ma = $_POST['httt_ma'];

                $data_order = array(
                    'dh_tongtien' => $dh_tongtien,
                    'dh_ngaylap' => $dh_ngaylap,
                    'dh_ngaygiao' => $dh_ngaygiao,
                    'dh_noigiao' => $dh_noigiao,
                    'dh_trangthaithanhtoan' => $dh_trangthaithanhtoan,
                    'httt_ma' => $httt_ma,
                    'kh_tendangnhap' => $kh_tendangnhap
                );

                $orderModel = $this->load->model('orderModel');
                $table_order = 'order';
                $result_orderId = $orderModel->insert_order_return_id($table_order, $data_order);

                if ($result_orderId > 0) {
                    // Thông tin các dòng chi tiết đơn hàng
                    $arr_id_product = $_POST['id_product'];                   // mảng array do đặt tên name="id_product[]"
                    $arr_od_soluong = $_POST['od_soluong'];   // mảng array do đặt tên name="od_soluong[]"
                    $arr_od_dongia = $_POST['od_dongia'];

                    $orderDetailModel = $this->load->model('orderDetailModel');
                    $table_order_detail = 'order_detail';

                    for ($i = 0; $i < count($arr_id_product); $i++) {
                        $id_product = $arr_id_product[$i];
                        $od_soluong = $arr_od_soluong[$i];
                        $od_dongia = $arr_od_dongia[$i];
                        $dh_ma = $result_orderId;

                        $data_order_detail = array(
                            'id_product' => $id_product,
                            'od_soluong' => $od_soluong,
                            'od_dongia' => $od_dongia,
                            'dh_ma' => $dh_ma
                        );


                        $result_order_detail = $orderDetailModel->insertorderDetail($table_order_detail, $data_order_detail);
                    }

                    $msg = "Thêm Đơn hàng thành công";
                    //Lưu session
                    Session::setArray("message", $msg);
                    header("Location:" . BASE_URL . "order_admin/add_order");
                } else {
                    $error = "Thêm Đơn hàng thất bại";
                    //Lưu session
                    Session::setArray("error", $error);
                    header("Location:" . BASE_URL . "order_admin/add_order");
                }
            } else {
                $error = "Khách hàng không tồn tại";
                //Lưu session
                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "order_admin/add_order");
            }
        } else {
            $error = "Vui lòng nhập đầy đủ thông tin";
            //Lưu session
            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "order_admin/add_order");
        }
    }

    public function show_edit_order($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào

        //lấy hinhthucthanhtoan
        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');
        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';
        $result_data['hinhthucthanhtoan'] = $hinhthucthanhtoanModel->hinhthucthanhtoan($table_hinhthucthanhtoan);

        //get customer

        $customerModel = $this->load->model('customerModel');
        $table_customer = 'customer';
        $result_customer = $customerModel->customer($table_customer);
        $result_data['customer'] = [];
        foreach ($result_customer as $customer) {
            $tomtat = 'Họ tên: ' . $customer['kh_ten'] . ", số điện thoại: " . $customer['kh_dienthoai'];

            $result_data['customer'][] = array(
                'kh_tendangnhap' => $customer['kh_tendangnhap'],
                'kh_tomtat' => $tomtat
            );
        }

        //get product
        $productModel = $this->load->model('productModel');
        $table_product = 'product';
        $result_data['product'] = $productModel->getProductNormal($table_product);


        $orderModel = $this->load->model('orderModel');
        $table_order = 'order';
        $result_order = $orderModel->orderbyid($table_order, $id);

        $data_order = array(
            'dh_ma' => $id,
            'dh_tongtien' => $result_order[0]['dh_tongtien'],
            'dh_ngaylap' => $result_order[0]['dh_ngaylap'],
            'dh_ngaygiao' => $result_order[0]['dh_ngaygiao'],
            'dh_noigiao' => $result_order[0]['dh_noigiao'],
            'dh_trangthaithanhtoan' => $result_order[0]['dh_trangthaithanhtoan'],
            'httt_ma' => $result_order[0]['httt_ma'],
            'httt_ten' => $result_order[0]['httt_ten'],
            'kh_tendangnhap' => $result_order[0]['kh_tendangnhap']
        );

        //Lấy customer
        $kh_tendangnhap = $result_order[0]['kh_tendangnhap'];
        $result_customer_byorder = $customerModel->customerbyUsername($table_customer, $kh_tendangnhap);
        $customerbyorder = array(
            'kh_tendangnhap' => $result_customer_byorder[0]['kh_tendangnhap'],
            'kh_ten' => $result_customer_byorder[0]['kh_ten'],
            'kh_gioitinh' => $result_customer_byorder[0]['kh_gioitinh'],
            'kh_email' => $result_customer_byorder[0]['kh_email'],
            'kh_diachi' => $result_customer_byorder[0]['kh_diachi'],
            'kh_dienthoai' => $result_customer_byorder[0]['kh_dienthoai'],
            'kh_ngaysinh' => $result_customer_byorder[0]['kh_ngaysinh'],
            'kh_cccd' => $result_customer_byorder[0]['kh_cccd'],
            'kh_status' => $result_customer_byorder[0]['kh_status']
        );

        if ($data_order['dh_tongtien'] >= 0) {
            // Thông tin các dòng chi tiết đơn hàng

            $orderDetailModel = $this->load->model('orderDetailModel');
            $table_order_detail = 'order_detail';
            $order_detail = $orderDetailModel->orderDetailbyMaDonHang($table_order_detail, $id);



            $result_data['data_order'] = $order_detail;
            $result_data['order'] = $data_order;
            $result_data['customerbyorder'] = $customerbyorder;
            $this->load->view('admin/order/edit_order', $result_data);
        } else {
            $error = "Chưa có đơn hàng";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL);
        }
    }
    public function show_order_detail($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào

        $orderModel = $this->load->model('orderModel');
        $table_order = 'order';
        $result_order = $orderModel->orderbyid($table_order, $id);

        $data_order = array(
            'dh_tongtien' => $result_order[0]['dh_tongtien'],
            'dh_ngaylap' => $result_order[0]['dh_ngaylap'],
            'dh_ngaygiao' => $result_order[0]['dh_ngaygiao'],
            'dh_noigiao' => $result_order[0]['dh_noigiao'],
            'dh_trangthaithanhtoan' => ($result_order[0]['dh_trangthaithanhtoan'] == 0) ? "Chưa thanh toán" : "Đã thanh toán",
            'httt_ma' => $result_order[0]['httt_ma'],
            'httt_ten' => $result_order[0]['httt_ten'],
            'kh_tendangnhap' => $result_order[0]['kh_tendangnhap']
        );

        //Lấy customer
        $kh_tendangnhap = $result_order[0]['kh_tendangnhap'];
        $customerModel = $this->load->model('customerModel');
        $table_customer = 'customer';
        $result_customer = $customerModel->customerbyUsername($table_customer, $kh_tendangnhap);
        $customer = array(
            'kh_tendangnhap' => $result_customer[0]['kh_tendangnhap'],
            'kh_ten' => $result_customer[0]['kh_ten'],
            'kh_gioitinh' => $result_customer[0]['kh_gioitinh'],
            'kh_email' => $result_customer[0]['kh_email'],
            'kh_diachi' => $result_customer[0]['kh_diachi'],
            'kh_dienthoai' => $result_customer[0]['kh_dienthoai'],
            'kh_ngaysinh' => $result_customer[0]['kh_ngaysinh'],
            'kh_cccd' => $result_customer[0]['kh_cccd'],
            'kh_status' => $result_customer[0]['kh_status']
        );

        if ($data_order['dh_tongtien'] >= 0) {
            // Thông tin các dòng chi tiết đơn hàng

            $orderDetailModel = $this->load->model('orderDetailModel');
            $table_order_detail = 'order_detail';
            $order_detail = $orderDetailModel->orderDetailbyMaDonHang($table_order_detail, $id);



            $result_data['data_order'] = $order_detail;
            $result_data['order'] = $data_order;
            $result_data['customer'] = $customer;
            $this->load->view('admin/order/order_detail', $result_data);
        } else {
            $error = "Chưa có đơn hàng";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL);
        }
    }

    public function update_order_admin($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        if (isset($_POST['kh_tendangnhap']) && isset($_POST['id_product']) && isset($_POST['od_soluong']) && isset($_POST['od_dongia'])) {
            $kh_tendangnhap = $_POST['kh_tendangnhap'];

            $customerModel = $this->load->model('customerModel');
            $table_customer = 'customer';
            $result_customer = $customerModel->customerbyUsername($table_customer, $kh_tendangnhap);

            if (isset($result_customer[0]['kh_tendangnhap'])) {
                // Thông tin đơn hàng
                $dh_ngaylap = $_POST['dh_ngaylap'];
                $dh_ngaygiao = $_POST['dh_ngaygiao'];
                $dh_noigiao = $_POST['dh_noigiao'];
                $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                $dh_tongtien = $_POST['dh_tongtien'];
                $httt_ma = $_POST['httt_ma'];

                $data_order = array(
                    'dh_tongtien' => $dh_tongtien,
                    'dh_ngaylap' => $dh_ngaylap,
                    'dh_ngaygiao' => $dh_ngaygiao,
                    'dh_noigiao' => $dh_noigiao,
                    'dh_trangthaithanhtoan' => $dh_trangthaithanhtoan,
                    'httt_ma' => $httt_ma,
                    'kh_tendangnhap' => $kh_tendangnhap
                );

                $orderModel = $this->load->model('orderModel');
                $table_order = 'order';
                $cond_order = "order.dh_ma='$id'";
                $result_order = $orderModel->updateorder($table_order, $data_order, $cond_order);

                if ($result_order == 1) {
                    // Thông tin các dòng chi tiết đơn hàng
                    $arr_id_product = $_POST['id_product'];                   // mảng array do đặt tên name="id_product[]"
                    $arr_od_soluong = $_POST['od_soluong'];   // mảng array do đặt tên name="od_soluong[]"
                    $arr_od_dongia = $_POST['od_dongia'];

                    //Xóa chi tiết đơn hàng
                    $orderDetailModel = $this->load->model('orderDetailModel');
                    $table_order_detail = 'order_detail';
                    $cond_order_detail = "order_detail.dh_ma='$id'";

                    $resultDeleteOrderDetail = $orderDetailModel->deleteorderDetail($table_order_detail, $cond_order_detail);

                    //Thêm lại các chi tiết đơn hàng khác
                    for ($i = 0; $i < count($arr_id_product); $i++) {
                        $id_product = $arr_id_product[$i];
                        $od_soluong = $arr_od_soluong[$i];
                        $od_dongia = $arr_od_dongia[$i];
                        $dh_ma = $id;

                        $data_order_detail = array(
                            'id_product' => $id_product,
                            'od_soluong' => $od_soluong,
                            'od_dongia' => $od_dongia,
                            'dh_ma' => $dh_ma
                        );


                        $result_order_detail = $orderDetailModel->insertorderDetail($table_order_detail, $data_order_detail);
                    }

                    $msg = "Cập nhật đơn hàng thành công";
                    //Lưu session
                    Session::setArray("message", $msg);
                    header("Location:" . BASE_URL . "order_admin/show_edit_order/" . $id);
                } else {
                    $error = "Cập nhật đơn hàng thất bại";
                    //Lưu session
                    Session::setArray("error", $error);
                    header("Location:" . BASE_URL . "order_admin/show_edit_order/" . $id);
                }
            } else {
                $error = "Khách hàng không tồn tại";
                //Lưu session
                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "order_admin/show_edit_order/" . $id);
            }
        } else {
            $error = "Vui lòng nhập đầy đủ thông tin";
            //Lưu session
            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "order_admin/show_edit_order/" . $id);
        }
    }
    public function delete_order($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào

        $orderModel = $this->load->model('orderModel');
        $table_order = 'order';
        $result_order = $orderModel->orderbyid($table_order, $id);

        if ($result_order[0]['dh_tongtien'] >= 0) {
            //Xóa chi tiết đơn hàng
            $orderDetailModel = $this->load->model('orderDetailModel');
            $table_order_detail = 'order_detail';
            $cond_order_detail = "order_detail.dh_ma='$id'";

            $resultDeleteOrderDetail = $orderDetailModel->deleteorderDetail($table_order_detail, $cond_order_detail);

            //Xoá đơn hàng
            $cond_order = "order.dh_ma='$id'";
            $result = $orderModel->deleteorder($table_order, $cond_order);

            $message = "Đã xoá đơn đặt hàng thành công";
            //Lưu session
            Session::setArray("error", $message);
            header("Location:" . BASE_URL . 'order_admin/list_order');
        } else {
            $error = "Chưa có đơn hàng";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . 'order_admin/list_order');
        }
    }
}
