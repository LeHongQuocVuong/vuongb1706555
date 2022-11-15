<?php
class product_producer extends dController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->add_product_producer();
    }

    public function add_product_producer()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');
        $this->load->view('admin/product_producer/add_product_producer');
        // $this->load->view('admin/footer');
    }

    public function insert_product_producer()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $productProducerModel = $this->load->model('productProducerModel');

        $table_product_producer = 'product_producer';

        if (isset($_POST['title_product_producer']) && $_POST['title_product_producer'] != "") {
            //read data
            $title = $_POST['title_product_producer'];
            $desc = $_POST['desc_product_producer'];

            $data = array(
                'title_product_producer' => $title,
                'desc_product_producer' => $desc
            );

            $result = $productProducerModel->insertproduct_producer($table_product_producer, $data);
            if ($result == 1) {
                $msg = "Thêm dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "product_producer/add_product_producer");
            } else {
                $error = "Thêm dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "product_producer/add_product_producer");
            }
        } else {
            $error = "Vui lòng nhập tên Nhà sản xuất";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "product_producer/add_product_producer");
        }
    }


    public function list_product_producer()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $productProducerModel = $this->load->model('productProducerModel');
        //lấy dữ liệu cho trang product_producer
        $table_product_producer = 'product_producer';
        $data['product_producer'] = $productProducerModel->product_producer($table_product_producer);

        $this->load->view('admin/product_producer/list_product_producer', $data);
        // $this->load->view('admin/footer');
    }


    public function show_update_product_producer($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $productProducerModel = $this->load->model('productProducerModel');

        $table_product_producer = 'product_producer';

        $data['product_producer'] = $productProducerModel->product_producerbyid($table_product_producer, $id);

        $this->load->view('admin/product_producer/update_product_producer', $data);
        // $this->load->view('admin/footer');
    }

    public function update_product_producer($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $productProducerModel = $this->load->model('productProducerModel');

        $table_product_producer = 'product_producer';
        if (isset($_POST['title_product_producer'])) {
            //read data
            $title = $_POST['title_product_producer'];
            $desc = $_POST['desc_product_producer'];


            $cond = "product_producer.id_product_producer='$id'";
            $data = array(
                'title_product_producer' => $title,
                'desc_product_producer' => $desc
            );

            $result = $productProducerModel->updateproduct_producer($table_product_producer, $data, $cond);
            if ($result == 1) {
                $msg = "Cập nhật dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "product_producer/list_product_producer");
            } else {
                $error = "Cập nhật dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "product_producer/list_product_producer");
            }
        } else {
            $error = "Vui lòng nhập tên Nhà sản xuất";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "product_producer/show_update_product_producer/$id");
        }
    }

    public function delete_product_producer($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $productProducerModel = $this->load->model('productProducerModel');

        $table_product_producer = 'product_producer';

        $cond = "product_producer.id_product_producer='$id'";


        $result = $productProducerModel->deleteproduct_producer($table_product_producer, $cond);
        if ($result == 1) {
            $msg = "Xoá dữ liệu thành công";
            //Lưu session

            Session::setArray("message", $msg);
            // header("Location:" . BASE_URL . "product_producer/list_product_producer");
        } else {
            $error = "Xoá dữ liệu thất bại";
            //Lưu session

            Session::setArray("error", $error);
            // header("Location:" . BASE_URL . "product_producer/list_product_producer");
        }

        // $this->load->view('addproduct_producer', $message);
    }
}
