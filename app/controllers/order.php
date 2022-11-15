<?php
class order extends dController
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $this->list_order();
    }

    // public function order()
    // {
    //     Session::init();

    //     $this->load->view('admin/header');
    //     $this->load->view('admin/menu');
    //     $this->load->view('admin/order/order');
    //     $this->load->view('admin/footer');
    // }

    // public function add_order()
    // {
    //     $this->load->view('admin/header');
    //     $this->load->view('admin/menu');
    //     $this->load->view('admin/order/add_order');
    //     $this->load->view('admin/footer');
    // }

    public function add_cart()
    {
        Session::init();

        $id_product = $_POST['id_product'];
        $title_product = $_POST['title_product'];
        $price_product = $_POST['price_product'];
        $name_product_image = $_POST['name_image'];
        $soluong = $_POST['soluong'];

        // Lưu trữ giỏ hàng trong session
        // Nếu khách hàng đặt hàng cùng sản phẩm đã có trong giỏ hàng => cập nhật lại Số lượng, Thành tiền
        if (isset($_SESSION['giohangdata'][$id_product])) {
            $capnhatsoluong = $_SESSION['giohangdata'][$id_product]['soluong'] + $soluong;
            $thanhtiencu = $_SESSION['giohangdata'][$id_product]['soluong'] * $price_product;
            $thanhtien = ($capnhatsoluong * $price_product);

            // $data = $_SESSION['giohangdata'];
            $data = array(
                'id_product' => $id_product,
                'title_product' => $title_product,
                'soluong' => $capnhatsoluong,
                'price_product' => $price_product,
                'thanhtien' => $thanhtien,
                'name_product_image' => $name_product_image
            );

            // lưu dữ liệu giỏ hàng vào session
            $_SESSION['giohangdata'][$id_product] = $data;
            //lưu tổng tiền
            if (isset($_SESSION['tongtiengiohang'])) {
                $_SESSION['tongtiengiohang'] = $_SESSION['tongtiengiohang'] - $thanhtiencu + $thanhtien;
            } else {
                $_SESSION['tongtiengiohang'] = $thanhtien;
            }
        } else { // Nếu khách hàng đặt hàng sản phẩm chưa có trong giỏ hàng => thêm vào
            $thanhtien = ($soluong * $price_product);
            $data = array(
                'id_product' => $id_product,
                'title_product' => $title_product,
                'soluong' => $soluong,
                'price_product' => $price_product,
                'thanhtien' => ($soluong * $price_product),
                'name_product_image' => $name_product_image
            );

            //lưu tổng tiền
            if (isset($_SESSION['tongtiengiohang'])) {
                $_SESSION['tongtiengiohang'] = $_SESSION['tongtiengiohang'] + $thanhtien;
            } else {
                $_SESSION['tongtiengiohang'] = $thanhtien;
            }

            // lưu dữ liệu giỏ hàng vào session
            $_SESSION['giohangdata'][$id_product] = $data;
        }

        //trả về dữ liêu cho ajax
        echo json_encode($_SESSION['giohangdata'][$id_product]);
    }


    public function show_cart()
    {
        Session::init();


        //Lấy hinhthucthanhtoan
        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');
        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';
        $result_data['hinhthucthanhtoan'] = $hinhthucthanhtoanModel->hinhthucthanhtoan($table_hinhthucthanhtoan);


        // Kiểm tra dữ liệu trong session
        $giohangdata = [];
        if (isset($_SESSION['giohangdata'])) {
            $giohangdata = $_SESSION['giohangdata'];
        } else {
            $giohangdata = [];
        }

        //lưu tổng tiền
        if (isset($_SESSION['tongtiengiohang'])) {
            $result_data['tongtiengiohang'] = $_SESSION['tongtiengiohang'];
        } else {
            $result_data['tongtiengiohang'] = 0;
        }

        $result_data['giohangdata'] = $giohangdata;
        $this->load->view('home/giohang', $result_data);
    }

    public function update_cart()
    {
        Session::init();

        $id_product = $_POST['id_product'];
        $soluong = $_POST['soluong'];

        // Lưu trữ giỏ hàng trong session
        // Nếu khách hàng đặt hàng cùng sản phẩm đã có trong giỏ hàng => cập nhật lại Số lượng, Thành tiền
        if (isset($_SESSION['giohangdata'][$id_product])) {
            $old_data = $_SESSION['giohangdata'][$id_product];

            $thanhtiencu = $old_data['soluong'] * $old_data['price_product'];
            $thanhtien = $soluong * $old_data['price_product'];

            // $data = $_SESSION['giohangdata'];
            $data = array(
                'id_product' => $id_product,
                'title_product' => $old_data['title_product'],
                'soluong' => $soluong,
                'price_product' => $old_data['price_product'],
                'thanhtien' => $thanhtien,
                'name_product_image' => $old_data['name_product_image']
            );

            // lưu dữ liệu giỏ hàng vào session
            $_SESSION['giohangdata'][$id_product] = $data;

            //lưu tổng tiền
            if (isset($_SESSION['tongtiengiohang'])) {
                $_SESSION['tongtiengiohang'] = $_SESSION['tongtiengiohang'] - $thanhtiencu + $thanhtien;
            } else {
                $_SESSION['tongtiengiohang'] = $thanhtien;
            }
        }

        //trả về dữ liêu cho ajax
        echo json_encode($_SESSION['giohangdata'][$id_product]);
    }

    public function delete_cart()
    {
        Session::init();

        $id_product = $_POST['id_product'];

        $old_data = $_SESSION['giohangdata'][$id_product];
        $thanhtiencu = $old_data['soluong'] * $old_data['price_product'];
        //lưu tổng tiền
        if (isset($_SESSION['tongtiengiohang'])) {
            $_SESSION['tongtiengiohang'] = $_SESSION['tongtiengiohang'] - $thanhtiencu;
        }

        // Lưu trữ giỏ hàng trong session
        // Nếu khách hàng đặt hàng cùng sản phẩm đã có trong giỏ hàng => cập nhật lại Số lượng, Thành tiền
        if (isset($_SESSION['giohangdata'][$id_product])) {
            // lưu dữ liệu giỏ hàng vào session
            unset($_SESSION['giohangdata'][$id_product]);
        }

        //trả về dữ liêu cho ajax
        echo json_encode($_SESSION['giohangdata']);
    }

    public function checkout()
    {
        Session::init();

        //sendmail
        require('mail/sendmail.php');

        //Lấy customer
        $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];

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

        // Thông tin đơn hàng
        $dh_tongtien = $_POST['dh_tongtien'];
        $dh_ngaylap = date('Y-m-d H:i:s'); // Lấy ngày hiện tại
        $dh_ngaygiao = date('Y-m-d H:i:s');
        $dh_noigiao = $_POST['dh_noigiao'];
        $dh_trangthaithanhtoan = 0; // Mặc định là 0 chưa thanh toán
        $httt_ma = $_POST['httt_ma']; // Mặc định là 1
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
            $giohangdata = $_SESSION['giohangdata'];

            $orderDetailModel = $this->load->model('orderDetailModel');
            $table_order_detail = 'order_detail';

            foreach ($giohangdata as $item) {
                $id_product = $item['id_product'];
                $od_soluong = $item['soluong'];
                $od_dongia = $item['price_product'];
                $dh_ma = $result_orderId;

                $data_order_detail = array(
                    'id_product' => $id_product,
                    'od_soluong' => $od_soluong,
                    'od_dongia' => $od_dongia,
                    'dh_ma' => $dh_ma
                );


                $result_order_detail = $orderDetailModel->insertorderDetail($table_order_detail, $data_order_detail);
            }

            $getOrderForSendMail = $orderModel->orderbyid($table_order, $result_orderId);
            //Nội dung mail
            $noidungMail = '<h1 style="text-align: center">Chi tiết đơn đặt hàng</h1>';
            $noidungMail .= '<h3 style="text-align: center">Chi tiết đơn đặt hàng</h3>';
            $noidungMail .= '<table border="1" width="50%" style="border-collapse: collapse; margin-left:auto; margin-right:auto"';
            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Tên khách hàng:</th>';
            $noidungMail .= '<td>' . $customer['kh_ten'] . '</td>';
            $noidungMail .= '</tr>';

            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Địa chỉ:</th>';
            $noidungMail .= '<td>' . $customer['kh_diachi'] . '</td>';
            $noidungMail .= '</tr>';

            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Số điện thoại:</th>';
            $noidungMail .= '<td>' . $customer['kh_dienthoai'] . '</td>';
            $noidungMail .= '</tr>';

            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Email:</th>';
            $noidungMail .= '<td>' . $customer['kh_email'] . '</td>';
            $noidungMail .= '</tr>';
            $noidungMail .= '</table>';

            $noidungMail .= '<h3 style="text-align: center">Thông tin đơn đặt hàng</h3>';

            $noidungMail .= '<table border="1" width="50%" style="border-collapse: collapse; margin-left:auto; margin-right:auto"';
            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Ngày đặt hàng:</th>';
            $noidungMail .= '<td>' . $data_order['dh_ngaylap'] . '</td>';
            $noidungMail .= '</tr>';

            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Địa chỉ giao hàng:</th>';
            $noidungMail .= '<td>' . $data_order['dh_noigiao'] . '</td>';
            $noidungMail .= '</tr>';

            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Hình thức thanh toán:</th>';
            $noidungMail .= '<td>' . $getOrderForSendMail['0']['httt_ten'] . '</td>';
            $noidungMail .= '</tr>';

            $noidungMail .= '<tr>';
            $noidungMail .= '<th>Tổng tiền:</th>';
            $noidungMail .= '<td>' . number_format($data_order['dh_tongtien'], 0) . '</td>';
            $noidungMail .= '</tr>';
            $noidungMail .= '</table>';

            $noidungMail .= '<h3 style="text-align: center">Chi tiết đơn đặt hàng</h3>';
            $noidungMail .= '<table border="1" width="75%" style="border-collapse: collapse; margin-left:auto; margin-right:auto"';

            // Thông tin các dòng chi tiết đơn hàng
            $order_detail = $orderDetailModel->orderDetailbyMaDonHang($table_order_detail, $result_orderId);

            $noidungMail .= '<thead>';
            $noidungMail .= '<tr>';
            $noidungMail .= '<th>STT</th>';
            $noidungMail .= '<th>Tên sản phẩm</th>';
            $noidungMail .= '<th>Số lượng</th>';
            $noidungMail .= '<th>Đơn giá</th>';
            $noidungMail .= '<th>Thành tiền</th>';
            $noidungMail .= '</tr>';
            $noidungMail .= '</thead>';
            $stt = 1;
            $noidungMail .= '<tbody>';
            foreach ($order_detail as $item) {
                $noidungMail .= '<tr>';
                $noidungMail .= '<td>' . $stt . '</td>';
                $stt += 1;
                $noidungMail .= '<td>' . $item['title_product'] . '</td>';
                $noidungMail .= '<td>' . $item['od_soluong'] . '</td>';
                $noidungMail .= '<td>' . number_format($item['od_dongia'], 0) . 'VNĐ </td>';
                $noidungMail .= '<td>' . number_format($item['od_dongia'] * $item['od_soluong'], 0) . 'VNĐ </td>';
                $noidungMail .= '</tr>';
            }
            $noidungMail .= '<tr>';
            $noidungMail .= '<th colspan="4" style="text-align: right;">Tổng tiền:</th>';
            $noidungMail .= '<td>' . number_format($data_order['dh_tongtien'], 0) . 'VNĐ </td>';
            $noidungMail .= '</tr>';
            $noidungMail .= '</tbody>';

            $noidungMail .= '</table>';

            $tieude = '[Xác nhận đơn hàng] Mã đơn hàng: ' . $result_orderId;
            $nguoinhan = $customer['kh_email'];
            //send mail
            $mail = new Mailer();
            $mail->dathangMail($nguoinhan, $tieude,  $noidungMail);


            //Xoá Session
            unset($_SESSION['tongtiengiohang']);
            unset($_SESSION['giohangdata']);

            $msg = "Thanh toán thành công";
            //Lưu session
            Session::init();
            Session::setArray("message", $msg);
            header("Location:" . BASE_URL . "order/list_order");
        } else {
            $error = "Thêm Đơn hàng thất bại";
            //Lưu session
            Session::init();
            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "order/show_cart");
        }
    }

    public function list_order()
    {
        Session::init();


        //Lấy customer
        $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];

        $customerModel = $this->load->model('customerModel');
        $table_customer = 'customer';
        $result_customer = $customerModel->customerbyUsername($table_customer, $kh_tendangnhap);

        if ($result_customer[0]['kh_tendangnhap'] != "") {
            //Danh sach don hang
            $orderModel = $this->load->model('orderModel');
            $table_order = 'order';
            $result_order = $orderModel->orderByUser($table_order, $kh_tendangnhap);

            $result_data['list_order'] = $result_order;
            $this->load->view('home/ds_donhang', $result_data);
        } else {
            $error = "Tài khoản không tồn tại";
            //Lưu session
            Session::init();
            Session::setArray("error", $error);
            header("Location:" . BASE_URL);
        }
    }

    public function show_order_detail($id)
    {
        Session::init();


        //Lấy customer
        $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];

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

        if ($data_order['dh_tongtien'] >= 0) {
            // Thông tin các dòng chi tiết đơn hàng

            $orderDetailModel = $this->load->model('orderDetailModel');
            $table_order_detail = 'order_detail';
            $order_detail = $orderDetailModel->orderDetailbyMaDonHang($table_order_detail, $id);



            $result_data['data_order'] = $order_detail;
            $result_data['order'] = $data_order;
            $result_data['customer'] = $customer;

            $this->load->view('home/donhang', $result_data);
        } else {
            $error = "Chưa có đơn hàng";
            //Lưu session
            Session::init();
            Session::setArray("error", $error);
            header("Location:" . BASE_URL);
        }
    }

    // public function send_mail($data)
    // {
    // }
}
