<?php
class customer extends dController
{
    public function __construct()
    {
        $data = array();
        $message = array();
        // Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        parent::__construct();
    }

    public function index()
    {
        $this->show_login();
    }

    public function show_login()
    {
        // Session::checkSession(); //Kiểm tra đã đăng nhập rồi thì chuyển vào dashboard
        Session::init();
        if (Session::get("customer_login") == true) {
            header("Location:" . BASE_URL);
            Session::setArray("message", "Bạn đã đăng nhập");
        }


        $this->load->view('home/dangnhap');
    }


    public function authentication_login()
    {
        $kh_tendangnhap = $_POST['kh_tendangnhap'];
        $kh_matkhau = md5($_POST['kh_matkhau']);

        $table = "customer";
        $customerModel = $this->load->model('customerModel');

        $count = $customerModel->login($table, $kh_tendangnhap, $kh_matkhau);

        if ($count == 0) {
            $message['msg'] = "Tên đăng nhập hoặc mật khẩu sai";
            header("Location:" . BASE_URL . "customer/show_login");
        } else {
            $result = $customerModel->getLogin($table, $kh_tendangnhap, $kh_matkhau);

            //Lưu session
            Session::init();
            Session::set("kh_tendangnhap_logged", $result[0]['kh_tendangnhap']);
            Session::set("kh_tendangnhap", $result[0]['kh_tendangnhap']);

            header("Location:" . BASE_URL);
        }
    }

    public function show_register()
    {
        // Session::checkSession(); //Kiểm tra đã đăng nhập rồi thì chuyển vào dashboard
        Session::init();
        if (Session::get("customer_login") == true) {
            header("Location:" . BASE_URL);
            Session::setArray("message", "Bạn đã đăng nhập");
        }


        $this->load->view('home/dangky');
    }

    public function register()
    {
        // Session::checkSession(); //Kiểm tra đã đăng nhập rồi thì chuyển vào dashboard
        Session::init();
        if (Session::get("customer_login") == true) {
            header("Location:" . BASE_URL);
            Session::setArray("message", "Bạn đã đăng nhập");
        }

        if (isset($_POST['kh_tendangnhap']) && isset($_POST['kh_matkhau'])) {
            $kh_tendangnhap = htmlentities($_POST['kh_tendangnhap']);
            $kh_matkhau = md5(htmlentities($_POST['kh_matkhau']));
            $kh_ten = htmlentities($_POST['kh_ten']);
            $kh_gioitinh = htmlentities($_POST['kh_gioitinh']);
            $kh_diachi = htmlentities($_POST['kh_diachi']);
            $kh_dienthoai = htmlentities($_POST['kh_dienthoai']);
            $kh_email = htmlentities($_POST['kh_email']);
            $kh_ngaysinh = htmlentities($_POST['kh_ngaysinh']);
            $kh_cccd = htmlentities($_POST['kh_cccd']);

            // Validate Tên đăng nhập_____________
            // required
            if (empty($kh_tendangnhap)) {
                Session::setArray("error", "Vui lòng nhập tên đăng nhập");
            }
            // Validate Tên mật khẩu_____________
            // required
            if (empty($kh_matkhau)) {
                Session::setArray("error", "Vui lòng nhập mật khẩu");
            }
            // Validate Tên _____________
            // required
            if (empty($kh_ten)) {
                Session::setArray("error", "Vui lòng nhập tên");
            }
            // Validate Giới tính_____________
            // required
            if (empty($kh_gioitinh) || $kh_gioitinh != 1 && $kh_gioitinh != 0) {
                Session::setArray("error", "Vui lòng nhập giới tính");
            }
            // Validate Địa chỉ_____________
            // required
            if (empty($kh_diachi)) {
                Session::setArray("error", "Vui lòng nhập địa chỉ");
            }
            // Validate Số điện thoại_____________
            // required
            if (empty($kh_dienthoai)) {
                Session::setArray("error", "Vui lòng nhập số điện thoại");
            }
            // Validate Email_____________
            // required
            if (empty($kh_email)) {
                Session::setArray("error", "Vui lòng nhập Email");
            }
            // Validate Ngày sinh_____________
            // required
            if (empty($kh_ngaysinh)) {
                Session::setArray("error", "Vui lòng nhập ngày sinh");
            }
            // Validate Căn cước_____________
            // required
            if (empty($kh_cccd)) {
                Session::setArray("error", "Vui lòng nhập căn cước công dân");
            }

            //Kiểm tra tên đăng nhập tồn tại chưa
            $customerModel = $this->load->model('customerModel');
            $table_customer = 'customer';
            $result = $customerModel->customerbyUsername($table_customer, $kh_tendangnhap);

            $check = 0;
            foreach ($result as $customer) {
                if ($customer['kh_tendangnhap'] != "") {
                    $check += 1;
                }
            }
            if ($check != 0) {
                Session::setArray("error", "Tên đăng nhập đã tồn tại, vui lòng chọn tên khác");
            }

            if (isset($_SESSION['error'])) {
                header("Location:" . BASE_URL);
            } {
                $data = array(
                    'kh_tendangnhap' => $kh_tendangnhap,
                    'kh_matkhau' => $kh_matkhau,
                    'kh_ten' => $kh_ten,
                    'kh_gioitinh' => $kh_gioitinh,
                    'kh_diachi' => $kh_diachi,
                    'kh_dienthoai' => $kh_dienthoai,
                    'kh_email' => $kh_email,
                    'kh_ngaysinh' => $kh_ngaysinh,
                    'kh_cccd' => $kh_cccd,
                    'kh_status' => 1,
                    'kh_created' => date('Y-m-d H:i:s')
                );

                $resultInsert = $customerModel->insertcustomer($table_customer, $data);
                if ($resultInsert == 1) {
                    $msg = "Đăng ký thành công";
                    //Lưu session
                    Session::init();
                    //Lưu session
                    Session::set("kh_tendangnhap_logged", $kh_tendangnhap);
                    Session::set("kh_tendangnhap", $kh_tendangnhap);
                    Session::setArray("message", $msg);
                    header("Location:" . BASE_URL);
                } else {
                    $error = "Đăng ký thất bại";
                    //Lưu session
                    Session::init();
                    Session::setArray("error", $error);
                    header("Location:" . BASE_URL . "customer/show_register");
                }
            }
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        header("Location:" . BASE_URL);
    }
}
