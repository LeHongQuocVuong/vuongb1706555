<?php
class hinhthucthanhtoan extends dController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->add_hinhthucthanhtoan();
    }

    public function add_hinhthucthanhtoan()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');
        $this->load->view('admin/hinhthucthanhtoan/add_hinhthucthanhtoan');
        // $this->load->view('admin/footer');
    }


    public function list_hinhthucthanhtoan()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');
        //lấy dữ liệu cho trang hinhthucthanhtoan
        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';
        $data['hinhthucthanhtoan'] = $hinhthucthanhtoanModel->hinhthucthanhtoan($table_hinhthucthanhtoan);

        $this->load->view('admin/hinhthucthanhtoan/list_hinhthucthanhtoan', $data);
        // $this->load->view('admin/footer');
    }

    public function insert_hinhthucthanhtoan()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');

        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';

        if (isset($_POST['httt_ten']) && $_POST['httt_ten'] != "") {
            //read data
            $title = $_POST['httt_ten'];
            $desc = $_POST['httt_desc'];

            $data = array(
                'httt_ten' => $title,
                'httt_desc' => $desc
            );

            $result = $hinhthucthanhtoanModel->inserthinhthucthanhtoan($table_hinhthucthanhtoan, $data);
            if ($result == 1) {
                $msg = "Thêm dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "hinhthucthanhtoan/add_hinhthucthanhtoan");
            } else {
                $error = "Thêm dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "hinhthucthanhtoan/add_hinhthucthanhtoan");
            }
        } else {
            $error = "Vui lòng nhập tên Hình thức thanh toán";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "hinhthucthanhtoan/add_hinhthucthanhtoan");
        }
    }

    public function show_update_hinhthucthanhtoan($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');

        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';

        $data['hinhthucthanhtoan'] = $hinhthucthanhtoanModel->hinhthucthanhtoanbyid($table_hinhthucthanhtoan, $id);

        $this->load->view('admin/hinhthucthanhtoan/update_hinhthucthanhtoan', $data);
        // $this->load->view('admin/footer');
    }

    public function update_hinhthucthanhtoan($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');

        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';
        if (isset($_POST['httt_ten'])) {
            //read data
            $title = $_POST['httt_ten'];
            $desc = $_POST['httt_desc'];


            $cond = "hinhthucthanhtoan.httt_ma='$id'";
            $data = array(
                'httt_ten' => $title,
                'httt_desc' => $desc
            );

            $result = $hinhthucthanhtoanModel->updatehinhthucthanhtoan($table_hinhthucthanhtoan, $data, $cond);
            if ($result == 1) {
                $msg = "Cập nhật dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "hinhthucthanhtoan/list_hinhthucthanhtoan");
            } else {
                $error = "Cập nhật dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "hinhthucthanhtoan/list_hinhthucthanhtoan");
            }
        } else {
            $error = "Vui lòng nhập tên Hình thức thanh toán";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "hinhthucthanhtoan/show_update_hinhthucthanhtoan/$id");
        }
    }

    public function delete_hinhthucthanhtoan($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $hinhthucthanhtoanModel = $this->load->model('hinhthucthanhtoanModel');

        $table_hinhthucthanhtoan = 'hinhthucthanhtoan';

        $cond = "hinhthucthanhtoan.httt_ma='$id'";


        $result = $hinhthucthanhtoanModel->deletehinhthucthanhtoan($table_hinhthucthanhtoan, $cond);
        if ($result == 1) {
            $msg = "Xoá dữ liệu thành công";
            //Lưu session

            Session::setArray("message", $msg);
            // header("Location:" . BASE_URL . "hinhthucthanhtoan/list_hinhthucthanhtoan");
        } else {
            $error = "Xoá dữ liệu thất bại";
            //Lưu session

            Session::setArray("error", $error);
            // header("Location:" . BASE_URL . "hinhthucthanhtoan/list_hinhthucthanhtoan");
        }

        // $this->load->view('addhinhthucthanhtoan', $message);
    }
}
