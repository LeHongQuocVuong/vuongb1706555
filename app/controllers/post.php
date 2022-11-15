<?php
class post extends dController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->add_post();
    }

    public function add_post()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào

        //Lấy category
        $postCategoryModel = $this->load->model('postCategoryModel');
        $table_category_post = 'post_category';
        $data['category'] = $postCategoryModel->category($table_category_post);


        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');
        $this->load->view('admin/post/add_post', $data);
        // $this->load->view('admin/footer');
    }

    public function insert_post()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $postModel = $this->load->model('postModel');

        $table_post = 'post';

        if (isset($_POST['title_post']) && $_POST['title_post'] != "") {
            //read data
            $title_post = $_POST['title_post'];
            $desc_post = $_POST['desc_post'];
            $created_post = date('Y-m-d H:i:s');
            $id_post_category = $_POST['id_post_category'];

            //Nếu có hình ảnh thì thêm
            if (isset($_FILES['image_name_post']['name']) && $_FILES['image_name_post']['name'] != "") {
                //upload file
                $tentaptin = $_FILES['image_name_post']['name'];
                //cắt tên file
                $div = explode('.', $tentaptin);
                $file_ext = strtolower(end($div));
                //Tạo Tên hình ảnh duy nhất            
                $image_name_post = $div[0] . '_' . date('YmdHis') . '.' . $file_ext;
            } else {
                $image_name_post = "";
            }

            $data_post = array(
                'title_post' => $title_post,
                'desc_post' => $desc_post,
                'created_post' => $created_post,
                'image_name_post' => $image_name_post,
                'id_post_category' => $id_post_category
            );

            $resultId = $postModel->insert_post_return_id($table_post, $data_post);
            // echo $resultId;
            if ($resultId > 0) {
                //Nếu có hình ảnh thì thêm
                if ($image_name_post != "") {
                    //path uploads
                    $path_uploads = "public/uploads/posts/" . $image_name_post;

                    //upload image
                    move_uploaded_file($_FILES['image_name_post']['tmp_name'], $path_uploads);
                    //upload image

                    $msg = "Thêm dữ liệu thành công";
                    //Lưu session

                    Session::setArray("message", $msg);
                    header("Location:" . BASE_URL . "post/add_post");
                } else { //nếu ko có hình ảnh thì thôi
                    $msg = "Thêm dữ liệu thành công";
                    //Lưu session

                    Session::setArray("message", $msg);
                    header("Location:" . BASE_URL . "post/add_post");
                }
            } else {
                $error = "Thêm dữ liệu Bài viết thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "post/add_post");
            }
        } else {
            $error = "Vui lòng nhập tên Bài viết";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "post/add_post");
        }
    }

    public function list_post()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $postModel = $this->load->model('postModel');
        //lấy dữ liệu
        $table_post = 'post';
        $result = $postModel->post($table_post);

        $ds_post = [];
        foreach ($result as $key => $value) {
            $ds_post[] = array(
                'id_post' => $value['id_post'],
                'title_post' => $value['title_post'],
                'desc_post' => $value['desc_post'],
                'created_post' => $value['created_post'],
                'image_name_post' => (isset($value['image_name_post']) && $value['image_name_post'] != "") ? BASE_URL . "public/uploads/posts/" . $value['image_name_post'] : "",
                'title_post_category' => $value['title_post_category']
            );
        }

        $data['post'] = $ds_post;

        $this->load->view('admin/post/list_post', $data);
        // $this->load->view('admin/footer');
    }
    public function show_post_detail($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $postModel = $this->load->model('postModel');
        //lấy dữ liệu
        $table_post = 'post';
        $result = $postModel->postbyid($table_post, $id);

        if ($result != null) {
            $data['post'] = array(
                'id_post' => $result[0]['id_post'],
                'title_post' => $result[0]['title_post'],
                'desc_post' => $result[0]['desc_post'],
                'image_name_post' => (isset($result[0]['image_name_post']) && $result[0]['image_name_post'] != "") ? BASE_URL . "public/uploads/posts/" . $result[0]['image_name_post'] : "",
                'title_post_category' => $result[0]['title_post_category']
            );

            $this->load->view('admin/post/show_post_detail', $data);
            $this->load->view('admin/footer');
        } else {
            $this->load->view('admin/post/show_post_detail');
            // $this->load->view('admin/footer');
        }
    }


    public function show_update_post($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        //Lấy category
        $postCategoryModel = $this->load->model('postCategoryModel');
        $table_category_post = 'post_category';
        $data['category'] = $postCategoryModel->category($table_category_post);

        $postModel = $this->load->model('postModel');
        //lấy dữ liệu
        $table_post = 'post';
        $result = $postModel->postbyid($table_post, $id);

        $data['post'] = array(
            'id_post' => $result[0]['id_post'],
            'title_post' => $result[0]['title_post'],
            'desc_post' => $result[0]['desc_post'],
            'image_url_post' => (isset($result[0]['image_name_post']) && $result[0]['image_name_post'] != "") ? BASE_URL . "public/uploads/posts/" . $result[0]['image_name_post'] : "",
            'old_image_name_post' => (isset($result[0]['image_name_post']) && $result[0]['image_name_post'] != "") ? $result[0]['image_name_post'] : "",
            'title_post_category' => $result[0]['title_post_category']
        );

        $this->load->view('admin/post/update_post', $data);
        // $this->load->view('admin/footer');
    }

    public function update_post($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $postModel = $this->load->model('postModel');

        $table_post = 'post';

        if (isset($_POST['title_post']) && $_POST['title_post'] != "") {
            //read data
            $title_post = $_POST['title_post'];
            $desc_post = $_POST['desc_post'];
            $created_post = date('Y-m-d H:i:s');
            $id_post_category = $_POST['id_post_category'];

            $old_image_name_post = (isset($_POST['old_image_name_post']) && $_POST['old_image_name_post'] != "") ? $_POST['old_image_name_post'] : "";

            //Nếu có hình ảnh thì thêm
            if (isset($_FILES['image_name_post']['name']) && $_FILES['image_name_post']['name'] != "") {
                //upload file
                $tentaptin = $_FILES['image_name_post']['name'];
                //cắt tên file
                $div = explode('.', $tentaptin);
                $file_ext = strtolower(end($div));
                //Tạo Tên hình ảnh duy nhất            
                $image_name_post = $div[0] . '_' . date('YmdHis') . '.' . $file_ext;
            } else {
                $image_name_post = "";
            }

            //update post
            $data_post = array(
                'title_post' => $title_post,
                'desc_post' => $desc_post,
                'created_post' => $created_post,
                'image_name_post' => ($image_name_post != "") ? $image_name_post : $old_image_name_post,
                'id_post_category' => $id_post_category
            );

            $cond_post = "post.id_post='$id'";

            $resultpost = $postModel->updatepost($table_post, $data_post, $cond_post);

            if ($resultpost == 1) {

                // nếu có update image
                if ($image_name_post != "") {
                    //path uploads
                    $path_uploads = "public/uploads/posts/" . $image_name_post;

                    //upload image
                    move_uploaded_file($_FILES['image_name_post']['tmp_name'], $path_uploads);
                    //upload image

                    if ($old_image_name_post != "") { //nếu có image cũ thì xoá nó
                        //delete file cũ
                        // Xóa file cũ để tránh rác trong thư mục UPLOADS
                        // Kiểm tra nếu file có tổn tại thì xóa file đi
                        $old_file = "public/uploads/posts/" . $old_image_name_post;
                        if (file_exists($old_file)) {
                            // Hàm unlink(filepath) dùng để xóa file trong PHP
                            unlink($old_file);
                        }
                    }


                    $message = "Cập nhật Bài viết thành công";
                    //Lưu session

                    Session::setArray("message", $message);
                    header("Location:" . BASE_URL . "post/show_update_post/" . $id);
                } else {
                    $message = "Cập nhật Bài viết thành công";
                    //Lưu session

                    Session::setArray("message", $message);
                    header("Location:" . BASE_URL . "post/show_update_post/" . $id);
                }
            } else {
                $error = "Cập nhật dữ liệu Bài viết thất bại";
                //Lưu session

                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "post/show_update_post/" . $id);
            }
        } else {
            $error = "Vui lòng nhập tên Bài viết";
            //Lưu session

            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "post/show_update_post/" . $id);
        }
    }

    public function delete_post($id)
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $postModel = $this->load->model('postModel');

        $table_post = 'post';

        $post = $postModel->postbyid($table_post, $id);

        $old_name = $post[0]['image_name_post'];

        //Xoá post
        $cond_deletepost = "post.id_post='$id'";
        $result = $postModel->deletepost($table_post, $cond_deletepost);

        if ($result == 1) {

            //delete file cũ
            // Xóa file cũ để tránh rác trong thư mục UPLOADS
            // Kiểm tra nếu file có tổn tại thì xóa file đi
            $old_file = "public/uploads/posts/" . $old_name;
            if (file_exists($old_file)) {
                // Hàm unlink(filepath) dùng để xóa file trong PHP
                unlink($old_file);
            }

            $msg = "Xoá Bài viết thành công";
            //Lưu session

            Session::setArray("message", $msg);
            // header("Location:" . BASE_URL . "post/list_post");
        } else {
            $error = "Xoá Bài viết thất bại";
            //Lưu session

            Session::setArray("error", $error);
            // header("Location:" . BASE_URL . "post/list_post");
        }
    }

    // Home ////////////////////////
    public function show_post_by_cate($id)
    {

        //Lấy category
        $postCategoryModel = $this->load->model('postCategoryModel');
        $table_category_post = 'post_category';
        $data['category'] = $postCategoryModel->category($table_category_post);

        $postModel = $this->load->model('postModel');
        $table_post = 'post';
        //lấy post theo category
        $data['postbyPostCateId'] = $postModel->postbyPostCateId($table_post, $id);

        //lấy tất cả bài viết, nhóm theo từng loại
        foreach ($data['category'] as $cate) {
            //lấy các post của mỗi loại
            $result = $postModel->postbyPostCateId($table_post, $cate['id_post_category']);

            //mảng các loại, trong đó 'posts' chứa danh sách các post của từng loại
            $data['postofcate'][$cate['id_post_category']]['id_post_category'] = $cate['id_post_category'];
            $data['postofcate'][$cate['id_post_category']]['title_post_category'] = $cate['title_post_category'];
            $data['postofcate'][$cate['id_post_category']]['desc_post_category'] = $cate['desc_post_category'];
            $data['postofcate'][$cate['id_post_category']]['posts'] = $result;
        }

        $this->load->view('home/post_list', $data);
    }

    public function show_post_home($id)
    {

        //Lấy category
        $postCategoryModel = $this->load->model('postCategoryModel');
        $table_category_post = 'post_category';
        $data['category'] = $postCategoryModel->category($table_category_post);

        $postModel = $this->load->model('postModel');
        $table_post = 'post';

        //lấy tất cả bài viết, nhóm theo từng loại
        foreach ($data['category'] as $cate) {
            //lấy các post của mỗi loại
            $result = $postModel->postbyPostCateId($table_post, $cate['id_post_category']);

            //mảng các loại, trong đó 'posts' chứa danh sách các post của từng loại
            $data['postofcate'][$cate['id_post_category']]['id_post_category'] = $cate['id_post_category'];
            $data['postofcate'][$cate['id_post_category']]['title_post_category'] = $cate['title_post_category'];
            $data['postofcate'][$cate['id_post_category']]['desc_post_category'] = $cate['desc_post_category'];
            $data['postofcate'][$cate['id_post_category']]['posts'] = $result;
        }

        //Lấy post theo id
        $result_post = $postModel->postbyid($table_post, $id);
        $data['post_detail'] = $result_post[0];

        $this->load->view('home/post_detail', $data);
    }
}
