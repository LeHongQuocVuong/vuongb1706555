<?php
class category extends dController
{
    public function __construct()
    {
        $data = array();
        $message = array();
        parent::__construct();
    }

    public function index()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->add_category_product();
    }

    public function add_category_product()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');
        $this->load->view('admin/category/add_category_product');
        // $this->load->view('admin/footer');
    }


    public function list_category_product()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $categoryModel = $this->load->model('categoryModel');
        //lấy dữ liệu cho trang category
        $table_category_product = 'category_product';
        $data['category'] = $categoryModel->category($table_category_product);

        $this->load->view('admin/category/list_category_product', $data);
        // $this->load->view('admin/footer');
    }

    // public function category_product_by_id($id)
    // {
    //     $this->load->view('header');

    //     $categoryModel = $this->load->model('categoryModel');
    //     //lấy dữ liệu cho trang categorybyid
    //     $table_category_product = 'category_product';
    //     $id = 1;
    //     $data['categorybyid'] = $categoryModel->categorybyid($table_category_product, $id);
    //     $this->load->view('categorybyid', $data);

    //     $this->load->view('footer');
    // }

    public function insert_category_product()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $categoryModel = $this->load->model('categoryModel');

        $table_category_product = 'category_product';

        if (isset($_POST['title_category_product']) && $_POST['title_category_product'] != "") {
            //read data
            $title = $_POST['title_category_product'];
            $desc = $_POST['desc_category_product'];

            $data = array(
                'title_category_product' => $title,
                'desc_category_product' => $desc
            );

            $result = $categoryModel->insertcategory($table_category_product, $data);
            if ($result == 1) {
                $msg = "Thêm dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "category/add_category_product");
            } else {
                $error = "Thêm dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "category/add_category_product");
            }
        } else {
            $error = "Vui lòng nhập tên Loại sản phẩm";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "category/add_category_product");
        }
    }

    public function show_update_category_product($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $categoryModel = $this->load->model('categoryModel');

        $table_category_product = 'category_product';

        $data['category'] = $categoryModel->categorybyid($table_category_product, $id);

        $this->load->view('admin/category/update_category_product', $data);
        // $this->load->view('admin/footer');
    }

    public function update_category_product($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $categoryModel = $this->load->model('categoryModel');

        $table_category_product = 'category_product';
        if (isset($_POST['title_category_product'])) {
            //read data
            $title = $_POST['title_category_product'];
            $desc = $_POST['desc_category_product'];


            $cond = "category_product.id_category_product='$id'";
            $data = array(
                'title_category_product' => $title,
                'desc_category_product' => $desc
            );

            $result = $categoryModel->updatecategory($table_category_product, $data, $cond);
            if ($result == 1) {
                $msg = "Cập nhật dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "category/list_category_product");
            } else {
                $error = "Cập nhật dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "category/list_category_product");
            }
        } else {
            $error = "Vui lòng nhập tên Loại sản phẩm";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "category/show_update_category_product/$id");
        }
    }

    public function delete_category_product($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $categoryModel = $this->load->model('categoryModel');

        $table_category_product = 'category_product';

        $cond = "category_product.id_category_product='$id'";


        $result = $categoryModel->deletecategory($table_category_product, $cond);
        if ($result == 1) {
            $msg = "Xoá dữ liệu thành công";
            //Lưu session

            Session::setArray("message", $msg);
            // header("Location:" . BASE_URL . "category/list_category_product");
        } else {
            $error = "Xoá dữ liệu thất bại";
            //Lưu session

            Session::setArray("error", $error);
            // header("Location:" . BASE_URL . "category/list_category_product");
        }

        // $this->load->view('addcategory', $message);
    }
}
