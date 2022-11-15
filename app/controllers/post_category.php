<?php
class post_category extends dController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->add_post_category();
    }

    public function add_post_category()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');
        $this->load->view('admin/post_category/add_post_category');
        // $this->load->view('admin/footer');
    }


    public function list_post_category()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $postCategoryModel = $this->load->model('postCategoryModel');
        //lấy dữ liệu cho trang category
        $table_post_category = 'post_category';
        $data['category'] = $postCategoryModel->category($table_post_category);

        $this->load->view('admin/post_category/list_post_category', $data);
        // $this->load->view('admin/footer');
    }

    public function insert_post_category()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $postCategoryModel = $this->load->model('postCategoryModel');

        $table_post_category = 'post_category';

        if (isset($_POST['title_post_category']) && $_POST['title_post_category'] != "") {
            //read data
            $title = $_POST['title_post_category'];
            $desc = $_POST['desc_post_category'];

            $data = array(
                'title_post_category' => $title,
                'desc_post_category' => $desc
            );

            $result = $postCategoryModel->insertcategory($table_post_category, $data);
            if ($result == 1) {
                $msg = "Thêm dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "post_category/add_post_category");
            } else {
                $error = "Thêm dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "post_category/add_post_category");
            }
        } else {
            $error = "Vui lòng nhập tên Loại bài viết";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "post_category/add_post_category");
        }
    }

    public function show_update_post_category($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $postCategoryModel = $this->load->model('postCategoryModel');

        $table_post_category = 'post_category';

        $data['category'] = $postCategoryModel->categorybyid($table_post_category, $id);

        $this->load->view('admin/post_category/update_post_category', $data);
        // $this->load->view('admin/footer');
    }

    public function update_post_category($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $postCategoryModel = $this->load->model('postCategoryModel');

        $table_post_category = 'post_category';
        if (isset($_POST['title_post_category'])) {
            //read data
            $title = $_POST['title_post_category'];
            $desc = $_POST['desc_post_category'];


            $cond = "post_category.id_post_category='$id'";
            $data = array(
                'title_post_category' => $title,
                'desc_post_category' => $desc
            );

            $result = $postCategoryModel->updatecategory($table_post_category, $data, $cond);
            if ($result == 1) {
                $msg = "Cập nhật dữ liệu thành công";
                //Lưu session

                Session::setArray("message", $msg);
                header("Location:" . BASE_URL . "post_category/list_post_category");
            } else {
                $error = "Cập nhật dữ liệu thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "post_category/list_post_category");
            }
        } else {
            $error = "Vui lòng nhập tên Loại bài viết";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "post_category/show_update_post_category/$id");
        }
    }

    public function delete_post_category($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $postCategoryModel = $this->load->model('postCategoryModel');

        $table_post_category = 'post_category';

        $cond = "post_category.id_post_category='$id'";


        $result = $postCategoryModel->deletecategory($table_post_category, $cond);
        if ($result == 1) {
            $msg = "Xoá dữ liệu thành công";
            //Lưu session

            Session::setArray("message", $msg);
            // header("Location:" . BASE_URL . "post_category/list_post_category");
        } else {
            $error = "Xoá dữ liệu thất bại";
            //Lưu session

            Session::setArray("error", $error);
            // header("Location:" . BASE_URL . "post_category/list_post_category");
        }

        // $this->load->view('addcategory', $message);
    }
}
