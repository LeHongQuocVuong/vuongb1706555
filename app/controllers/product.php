<?php
class product extends dController
{
    public function __construct()
    {
        parent::__construct();
    }

    // Admin
    public function index()
    {
        $this->add_product();
    }

    public function add_product()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào

        //Lấy category
        $categoryModel = $this->load->model('categoryModel');
        $table_category_product = 'category_product';
        $data['category'] = $categoryModel->category($table_category_product);

        //Get product_producer
        $productProducerModel = $this->load->model('productProducerModel');
        $table_product_producer = 'product_producer';
        $data['product_producer'] = $productProducerModel->product_producer($table_product_producer);


        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');
        $this->load->view('admin/product/add_product', $data);
        // $this->load->view('admin/footer');
    }

    public function insert_product()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $productModel = $this->load->model('productModel');
        $productDetailModel = $this->load->model('productDetailModel');
        $productImageModel = $this->load->model('productImageModel');

        $table_product = 'product';
        $table_product_detail = 'product_detail';
        $table_product_image = 'product_image';

        if (isset($_POST['title_product']) && $_POST['title_product'] != "") {
            //read data
            $title_product = $_POST['title_product'];
            $price_product = $_POST['price_product'];
            $old_price_product = $_POST['old_price_product'];
            $quantity_product = $_POST['quantity_product'];
            $short_desc_product = $_POST['short_desc_product'];
            $long_desc_product = $_POST['long_desc_product'];
            $created_product = date('Y-m-d H:i:s');
            $id_category_product = $_POST['id_category_product'];
            $id_product_producer = $_POST['id_product_producer'];



            $data_product = array(
                'title_product' => $title_product,
                'price_product' => $price_product,
                'old_price_product' => $old_price_product,
                'quantity_product' => $quantity_product,
                'short_desc_product' => $short_desc_product,
                'long_desc_product' => $long_desc_product,
                'created_product' => $created_product,
                // 'image_product' => $image_product,
                'id_category_product' => $id_category_product,
                'id_product_producer' => $id_product_producer
            );

            $resultId = $productModel->insert_product_return_id($table_product, $data_product);
            // echo $resultId;
            if ($resultId > 0) {
                //Add product_detail
                $display_product_detail = $_POST['display_product_detail'];
                $os_product_detail = $_POST['os_product_detail'];
                $main_camera_product_detail = $_POST['main_camera_product_detail'];
                $selfie_camera_product_detail = $_POST['selfie_camera_product_detail'];
                $cpu_product_detail = $_POST['cpu_product_detail'];
                $ram_product_detail = $_POST['ram_product_detail'];
                $rom_product_detail = $_POST['rom_product_detail'];
                $battery_product_detail = $_POST['battery_product_detail'];

                $data_product_detail = array(
                    'display_product_detail' => $display_product_detail,
                    'os_product_detail' => $os_product_detail,
                    'main_camera_product_detail' => $main_camera_product_detail,
                    'selfie_camera_product_detail' => $selfie_camera_product_detail,
                    'cpu_product_detail' => $cpu_product_detail,
                    'ram_product_detail' => $ram_product_detail,
                    'rom_product_detail' => $rom_product_detail,
                    'battery_product_detail' => $battery_product_detail,
                    'id_product' => $resultId
                );
                $result_product_detail_ID = $productDetailModel->insert_product_detail_return_id($table_product_detail, $data_product_detail);

                if ($result_product_detail_ID > 0) {
                    //Nếu có hình ảnh thì thêm
                    if (isset($_FILES['name_product_image']['name']) && $_FILES['name_product_image']['name'] != "") {
                        //upload file
                        $tentaptin = $_FILES['name_product_image']['name'];
                        //cắt tên file
                        $div = explode('.', $tentaptin);
                        $file_ext = strtolower(end($div));
                        //Tạo Tên hình ảnh duy nhất            
                        $name_product_image = $div[0] . '_' . date('YmdHis') . '.' . $file_ext;
                        //path uploads
                        $path_uploads = "public/uploads/products/" . $name_product_image;

                        //Add product_image
                        $data_product_image = array(
                            'name_product_image' => $name_product_image,
                            'id_product' => $resultId
                        );
                        $result_product_image = $productImageModel->insertproduct_image($table_product_image, $data_product_image);

                        if ($result_product_image == 1) {
                            //upload image
                            move_uploaded_file($_FILES['name_product_image']['tmp_name'], $path_uploads);
                            //upload image

                            $msg = "Thêm dữ liệu thành công";
                            //Lưu session
                            Session::setArray("message", $msg);
                            header("Location:" . BASE_URL . "product/add_product");
                        } else {
                            //ko thêm được detail thì xoá product, product_detail
                            //Xoá product_detail
                            $cond_deleteproduct_detail = "product_detail.id_product_detail='$result_product_detail_ID'";

                            $resultDeleteProductDetail = $productDetailModel->deleteproduct_detail($table_product, $cond_deleteproduct_detail);

                            //Xoá product
                            $cond_deleteproduct = "product.id_product='$resultId'";

                            $resultDeleteProduct = $productModel->deleteproduct($table_product, $cond_deleteproduct);

                            $error = "Thêm Product Image thất bại";
                            //Lưu session
                            Session::setArray("error", $error);
                            header("Location:" . BASE_URL . "product/add_product");
                        }
                    } else { //nếu ko có hình ảnh thì thôi
                        $msg = "Thêm dữ liệu thành công";
                        //Lưu session
                        Session::setArray("message", $msg);
                        header("Location:" . BASE_URL . "product/add_product");
                    }
                } else { //ko thêm được detail thì xoá product
                    //Xoá product
                    $cond_deleteproduct = "product.id_product='$resultId'";

                    $resultDeleteProduct = $productModel->deleteproduct($table_product, $cond_deleteproduct);

                    $error = "Thêm Product Detail thất bại";
                    //Lưu session
                    Session::setArray("error", $error);
                    header("Location:" . BASE_URL . "product/add_product");
                }
            } else {
                $error = "Thêm dữ liệu Sản phẩm thất bại";
                //Lưu session
                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "product/add_product");
            }
        } else {
            $error = "Vui lòng nhập tên Sản phẩm";
            //Lưu session
            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "product/add_product");
        }
    }

    public function list_product()
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $productModel = $this->load->model('productModel');
        //lấy dữ liệu
        $table_product = 'product';
        $result = $productModel->product($table_product);

        $ds_sp = [];
        foreach ($result as $key => $value) {
            $ds_sp[] = array(
                'id_product' => $value['id_product'],
                'title_product' => $value['title_product'],
                'price_product' => number_format($value['price_product'], 0) . " VNĐ",
                'quantity_product' => $value['quantity_product'],
                'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                'title_category_product' => $value['title_category_product'],
                'title_product_producer' => $value['title_product_producer']
            );
        }

        $data['product'] = $ds_sp;

        $this->load->view('admin/product/list_product', $data);
        // $this->load->view('admin/footer');
    }
    public function show_product_detail($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        $productModel = $this->load->model('productModel');
        //lấy dữ liệu
        $table_product = 'product';
        $result = $productModel->productbyid($table_product, $id);

        if ($result != null) {
            $data['product'] = array(
                'id_product' => $result[0]['id_product'],
                'title_product' => $result[0]['title_product'],
                'price_product' => number_format($result[0]['price_product'], 0) . " VNĐ",
                'old_price_product' => number_format($result[0]['old_price_product'], 0) . " VNĐ",
                'quantity_product' => $result[0]['quantity_product'],
                'name_product_image' => (isset($result[0]['name_product_image']) && $result[0]['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $result[0]['name_product_image'] : "",
                'title_category_product' => $result[0]['title_category_product'],
                'title_product_producer' => $result[0]['title_product_producer']
            );
            if (isset($result[0]['short_desc_product']) && $result[0]['short_desc_product'] != "") {
                $data['product'] += ['short_desc_product' => $result[0]['short_desc_product']];
            }

            if (isset($result[0]['long_desc_product']) && $result[0]['long_desc_product'] != "") {
                $data['product'] += ['long_desc_product' => $result[0]['long_desc_product']];
            }
            if (isset($result[0]['display_product_detail']) && $result[0]['display_product_detail'] != "") {
                $data['product'] += ['display_product_detail' => $result[0]['display_product_detail']];
            }
            if (isset($result[0]['os_product_detail']) && $result[0]['os_product_detail'] != "") {
                $data['product'] += ['os_product_detail' => $result[0]['os_product_detail']];
            }

            if (isset($result[0]['main_camera_product_detail']) && $result[0]['main_camera_product_detail'] != "") {
                $data['product'] += ['main_camera_product_detail' => $result[0]['main_camera_product_detail']];
            }
            if (isset($result[0]['selfie_camera_product_detail']) && $result[0]['selfie_camera_product_detail'] != "") {
                $data['product'] += ['selfie_camera_product_detail' => $result[0]['selfie_camera_product_detail']];
            }
            if (isset($result[0]['cpu_product_detail']) && $result[0]['cpu_product_detail'] != "") {
                $data['product'] += ['cpu_product_detail' => $result[0]['cpu_product_detail']];
            }

            if (isset($result[0]['ram_product_detail']) && $result[0]['ram_product_detail'] != "") {
                $data['product'] += ['ram_product_detail' => $result[0]['ram_product_detail']];
            }

            if (isset($result[0]['rom_product_detail']) && $result[0]['rom_product_detail'] != "") {
                $data['product'] += ['rom_product_detail' => $result[0]['rom_product_detail']];
            }

            if (isset($result[0]['battery_product_detail']) && $result[0]['battery_product_detail'] != "") {
                $data['product'] += ['battery_product_detail' => $result[0]['battery_product_detail']];
            }


            $this->load->view('admin/product/show_product_detail', $data);
            // $this->load->view('admin/footer');
        } else {
            $this->load->view('admin/product/show_product_detail');
            // $this->load->view('admin/footer');
        }
    }

    public function show_update_product($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        // $this->load->view('admin/header');
        // $this->load->view('admin/menu');

        //Lấy category
        $categoryModel = $this->load->model('categoryModel');
        $table_category_product = 'category_product';
        $data['category'] = $categoryModel->category($table_category_product);

        //Get product_producer
        $productProducerModel = $this->load->model('productProducerModel');
        $table_product_producer = 'product_producer';
        $data['product_producer'] = $productProducerModel->product_producer($table_product_producer);


        $productModel = $this->load->model('productModel');
        //lấy dữ liệu
        $table_product = 'product';
        $result = $productModel->productbyid($table_product, $id);

        $data['product'] = array(
            'id_product' => $result[0]['id_product'],
            'title_product' => $result[0]['title_product'],
            'price_product' => $result[0]['price_product'],
            'old_price_product' => $result[0]['old_price_product'],
            'quantity_product' => $result[0]['quantity_product'],
            'id_product_image' => (isset($result[0]['id_product_image']) && $result[0]['id_product_image'] != "") ? $result[0]['id_product_image'] : "",
            'name_product_image' => (isset($result[0]['name_product_image']) && $result[0]['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $result[0]['name_product_image'] : "",
            'id_product_detail' => $result[0]['id_product_detail'],
            'id_category_product' => $result[0]['id_category_product'],
            'id_product_producer' => $result[0]['id_product_producer']
        );

        if (isset($result[0]['short_desc_product']) && $result[0]['short_desc_product'] != "") {
            $data['product'] += ['short_desc_product' => $result[0]['short_desc_product']];
        }

        if (isset($result[0]['long_desc_product']) && $result[0]['long_desc_product'] != "") {
            $data['product'] += ['long_desc_product' => $result[0]['long_desc_product']];
        }
        if (isset($result[0]['display_product_detail']) && $result[0]['display_product_detail'] != "") {
            $data['product'] += ['display_product_detail' => $result[0]['display_product_detail']];
        }
        if (isset($result[0]['os_product_detail']) && $result[0]['os_product_detail'] != "") {
            $data['product'] += ['os_product_detail' => $result[0]['os_product_detail']];
        }

        if (isset($result[0]['main_camera_product_detail']) && $result[0]['main_camera_product_detail'] != "") {
            $data['product'] += ['main_camera_product_detail' => $result[0]['main_camera_product_detail']];
        }
        if (isset($result[0]['selfie_camera_product_detail']) && $result[0]['selfie_camera_product_detail'] != "") {
            $data['product'] += ['selfie_camera_product_detail' => $result[0]['selfie_camera_product_detail']];
        }
        if (isset($result[0]['cpu_product_detail']) && $result[0]['cpu_product_detail'] != "") {
            $data['product'] += ['cpu_product_detail' => $result[0]['cpu_product_detail']];
        }

        if (isset($result[0]['ram_product_detail']) && $result[0]['ram_product_detail'] != "") {
            $data['product'] += ['ram_product_detail' => $result[0]['ram_product_detail']];
        }

        if (isset($result[0]['rom_product_detail']) && $result[0]['rom_product_detail'] != "") {
            $data['product'] += ['rom_product_detail' => $result[0]['rom_product_detail']];
        }

        if (isset($result[0]['battery_product_detail']) && $result[0]['battery_product_detail'] != "") {
            $data['product'] += ['battery_product_detail' => $result[0]['battery_product_detail']];
        }

        $this->load->view('admin/product/update_product', $data);
        // $this->load->view('admin/footer');
    }

    public function update_product($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $productModel = $this->load->model('productModel');
        $productDetailModel = $this->load->model('productDetailModel');
        $productImageModel = $this->load->model('productImageModel');

        $table_product = 'product';
        $table_product_detail = 'product_detail';
        $table_product_image = 'product_image';

        if (isset($_POST['title_product']) && $_POST['title_product'] != "") {
            //read data
            $title_product = $_POST['title_product'];
            $price_product = $_POST['price_product'];
            $old_price_product = $_POST['old_price_product'];
            $quantity_product = $_POST['quantity_product'];
            $short_desc_product = $_POST['short_desc_product'];
            $long_desc_product = $_POST['long_desc_product'];
            $created_product = date('Y-m-d H:i:s');
            $id_category_product = $_POST['id_category_product'];
            $id_product_producer = $_POST['id_product_producer'];

            $id_product_detail = $_POST['id_product_detail'];

            //update product
            $data_product = array(
                'title_product' => $title_product,
                'price_product' => $price_product,
                'old_price_product' => $old_price_product,
                'quantity_product' => $quantity_product,
                'short_desc_product' => $short_desc_product,
                'long_desc_product' => $long_desc_product,
                'created_product' => $created_product,
                // 'image_product' => $image_product,
                'id_category_product' => $id_category_product,
                'id_product_producer' => $id_product_producer
            );

            $cond_product = "product.id_product='$id'";

            $resultProduct = $productModel->updateproduct($table_product, $data_product, $cond_product);
            // echo $resultId;
            if ($resultProduct == 1) {
                //update product detail
                $display_product_detail = $_POST['display_product_detail'];
                $os_product_detail = $_POST['os_product_detail'];
                $main_camera_product_detail = $_POST['main_camera_product_detail'];
                $selfie_camera_product_detail = $_POST['selfie_camera_product_detail'];
                $cpu_product_detail = $_POST['cpu_product_detail'];
                $ram_product_detail = $_POST['ram_product_detail'];
                $rom_product_detail = $_POST['rom_product_detail'];
                $battery_product_detail = $_POST['battery_product_detail'];
                $data_product_detail = array(
                    'display_product_detail' => $display_product_detail,
                    'os_product_detail' => $os_product_detail,
                    'main_camera_product_detail' => $main_camera_product_detail,
                    'selfie_camera_product_detail' => $selfie_camera_product_detail,
                    'cpu_product_detail' => $cpu_product_detail,
                    'ram_product_detail' => $ram_product_detail,
                    'rom_product_detail' => $rom_product_detail,
                    'battery_product_detail' => $battery_product_detail
                );

                $cond_product_detail = "product_detail.id_product_detail='$id_product_detail'";
                $result_product_detail = $productDetailModel->updateproduct_detail($table_product_detail, $data_product_detail, $cond_product_detail);

                if ($result_product_detail == 1) {

                    //update image 
                    if (isset($_FILES['name_product_image']['name']) && $_FILES['name_product_image']['name'] != "") {
                        //upload file
                        $tentaptin = $_FILES['name_product_image']['name'];
                        //cắt tên file
                        $div = explode('.', $tentaptin);
                        $file_ext = strtolower(end($div));
                        //Tạo Tên hình ảnh duy nhất            
                        $name_product_image = $div[0] . '_' . date('YmdHis') . '.' . $file_ext;
                        //path uploads
                        $path_uploads = "public/uploads/products/" . $name_product_image;

                        // nếu có image trong database từ trước
                        if (isset($_POST['id_product_image']) && $_POST['id_product_image'] != "") {

                            $id_product_image = $_POST['id_product_image'];

                            $old_product_image = $productImageModel->product_imagebyid($table_product_image, $id_product_image);
                            $old_product_image_name = $old_product_image[0]['name_product_image'];

                            //Add product_image
                            $data_product_image = array(
                                'name_product_image' => $name_product_image
                            );

                            $cond_product_image = "product_image.id_product_image='$id_product_image'";

                            $result_product_image = $productImageModel->updateproduct_image($table_product_image, $data_product_image, $cond_product_image);

                            if ($result_product_image == 1) {
                                //upload image
                                move_uploaded_file($_FILES['name_product_image']['tmp_name'], $path_uploads);
                                //upload image

                                //delete file cũ
                                // Xóa file cũ để tránh rác trong thư mục UPLOADS
                                // Kiểm tra nếu file có tổn tại thì xóa file đi
                                $old_file = "public/uploads/products/" . $old_product_image_name;
                                if (file_exists($old_file)) {
                                    // Hàm unlink(filepath) dùng để xóa file trong PHP
                                    unlink($old_file);
                                }

                                $message = "Cập nhật Sản phẩm thành công";
                                //Lưu session
                                Session::setArray("message", $message);
                                header("Location:" . BASE_URL . "product/show_update_product/" . $id);
                            } else {

                                $error = "Cập nhật Product Image thất bại";
                                //Lưu session
                                Session::setArray("error", $error);
                                header("Location:" . BASE_URL . "product/show_update_product/" . $id);
                            }
                        } else { //// nếu chưa có image trong database từ trước
                            //Tạo image
                            //upload file
                            $tentaptin = $_FILES['name_product_image']['name'];
                            //cắt tên file
                            $div = explode('.', $tentaptin);
                            $file_ext = strtolower(end($div));
                            //Tạo Tên hình ảnh duy nhất            
                            $name_product_image = $div[0] . '_' . date('YmdHis') . '.' . $file_ext;
                            //path uploads
                            $path_uploads = "public/uploads/products/" . $name_product_image;

                            //Add product_image
                            $data_product_image = array(
                                'name_product_image' => $name_product_image,
                                'id_product' => $id
                            );
                            $result_product_image = $productImageModel->insertproduct_image($table_product_image, $data_product_image);

                            if ($result_product_image == 1) {
                                //upload image
                                move_uploaded_file($_FILES['name_product_image']['tmp_name'], $path_uploads);
                                //upload image

                                $msg = "Cập nhật liệu thành công";
                                //Lưu session
                                Session::setArray("message", $msg);
                                header("Location:" . BASE_URL . "product/show_update_product/" . $id);
                            } else {

                                $error = "Thêm Product Image thất bại";
                                //Lưu session
                                Session::setArray("error", $error);
                                header("Location:" . BASE_URL . "product/show_update_product/" . $id);
                            }
                        }
                    } else {
                        $message = "Cập nhật Sản phẩm thành công";
                        //Lưu session
                        Session::setArray("message", $message);
                        header("Location:" . BASE_URL . "product/show_update_product/" . $id);
                    }
                } else {
                    $error = "Cập nhật Chi tiết Sản phẩm thất bại";
                    //Lưu session
                    Session::setArray("error", $error);
                    header("Location:" . BASE_URL . "product/show_update_product/" . $id);
                }
            } else {
                $error = "Cập nhật dữ liệu Sản phẩm thất bại";
                //Lưu session
                Session::setArray("error", $error);
                header("Location:" . BASE_URL . "product/show_update_product/" . $id);
            }
        } else {
            $error = "Vui lòng nhập tên Sản phẩm";
            //Lưu session
            Session::setArray("error", $error);
            header("Location:" . BASE_URL . "product/show_update_product/" . $id);
        }
    }

    public function delete_product($id)
    {
        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $productModel = $this->load->model('productModel');
        $productDetailModel = $this->load->model('productDetailModel');
        $productImageModel = $this->load->model('productImageModel');

        $table_product = 'product';
        $table_product_detail = 'product_detail';
        $table_product_image = 'product_image';

        //Xoá image
        $product_image = $productImageModel->product_imagebyidproduct($table_product_image, $id);
        $result_product_image = 0;
        foreach ($product_image as $key => $value) {
            $id_product_image = $value['id_product_image'];
            $name_product_image = $value['name_product_image'];
            $cond_deleteproduct_image = "product_image.id_product_image='$id_product_image'";
            $result_product_image = $productImageModel->deleteproduct_image($table_product_image, $cond_deleteproduct_image);

            if ($result_product_image == 1) {
                //delete file cũ
                // Xóa file cũ để tránh rác trong thư mục UPLOADS
                // Kiểm tra nếu file có tổn tại thì xóa file đi
                $old_file = "public/uploads/products/" . $name_product_image;
                if (file_exists($old_file)) {
                    // Hàm unlink(filepath) dùng để xóa file trong PHP
                    unlink($old_file);
                }
            }
        }

        if ($result_product_image == 1) {
            // Xoá detail
            $product_detail = $productDetailModel->product_detailbyidproduct($table_product_detail, $id);
            foreach ($product_detail as $key => $value) {
                $id_product_detail = $value['id_product_detail'];
                $cond_deleteproduct_detail = "product_detail.id_product_detail='$id_product_detail'";
                $result_product_detail = $productDetailModel->deleteproduct_detail($table_product_detail, $cond_deleteproduct_detail);
            }

            if ($result_product_detail == 1) {
                //Xoá product
                $cond_deleteproduct = "product.id_product='$id'";
                $result = $productModel->deleteproduct($table_product, $cond_deleteproduct);

                if ($result == 1) {
                    $msg = "Xoá Sản phẩm thành công";
                    //Lưu session
                    Session::setArray("message", $msg);
                    // header("Location:" . BASE_URL . "product/list_product");
                } else {
                    $error = "Xoá Sản phẩm thất bại";
                    //Lưu session
                    Session::setArray("error", $error);
                    // header("Location:" . BASE_URL . "product/list_product");
                }
            } else {
                $error = "Xoá Chi tiết Sản phẩm thất bại";
                //Lưu session
                Session::setArray("error", $error);
                // header("Location:" . BASE_URL . "product/list_product");
            }
        } else {
            $error = "Xoá Hình ảnh Sản phẩm thất bại";
            //Lưu session
            Session::setArray("error", $error);
            // header("Location:" . BASE_URL . "product/list_product");
        }
    }
    // Admin

    //home page _________________________
    public function show_product_detail_home($id)
    {
        Session::init();

        $productModel = $this->load->model('productModel');
        //lấy dữ liệu
        $table_product = 'product';
        $result = $productModel->productbyid($table_product, $id);

        if ($result != null) {
            $data['product'] = array(
                'id_product' => $result[0]['id_product'],
                'title_product' => $result[0]['title_product'],
                'price_product' => $result[0]['price_product'],
                'old_price_product' => $result[0]['old_price_product'],
                'quantity_product' => $result[0]['quantity_product'],
                'name_product_image' => (isset($result[0]['name_product_image']) && $result[0]['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $result[0]['name_product_image'] : "",
                'name_image' => (isset($result[0]['name_product_image']) && $result[0]['name_product_image'] != "") ? $result[0]['name_product_image'] : "",
                'title_category_product' => $result[0]['title_category_product'],
                'title_product_producer' => $result[0]['title_product_producer']
            );
            if (isset($result[0]['short_desc_product']) && $result[0]['short_desc_product'] != "") {
                $data['product'] += ['short_desc_product' => $result[0]['short_desc_product']];
            }

            if (isset($result[0]['long_desc_product']) && $result[0]['long_desc_product'] != "") {
                $data['product'] += ['long_desc_product' => $result[0]['long_desc_product']];
            }
            if (isset($result[0]['display_product_detail']) && $result[0]['display_product_detail'] != "") {
                $data['product'] += ['display_product_detail' => $result[0]['display_product_detail']];
            }
            if (isset($result[0]['os_product_detail']) && $result[0]['os_product_detail'] != "") {
                $data['product'] += ['os_product_detail' => $result[0]['os_product_detail']];
            }

            if (isset($result[0]['main_camera_product_detail']) && $result[0]['main_camera_product_detail'] != "") {
                $data['product'] += ['main_camera_product_detail' => $result[0]['main_camera_product_detail']];
            }
            if (isset($result[0]['selfie_camera_product_detail']) && $result[0]['selfie_camera_product_detail'] != "") {
                $data['product'] += ['selfie_camera_product_detail' => $result[0]['selfie_camera_product_detail']];
            }
            if (isset($result[0]['cpu_product_detail']) && $result[0]['cpu_product_detail'] != "") {
                $data['product'] += ['cpu_product_detail' => $result[0]['cpu_product_detail']];
            }

            if (isset($result[0]['ram_product_detail']) && $result[0]['ram_product_detail'] != "") {
                $data['product'] += ['ram_product_detail' => $result[0]['ram_product_detail']];
            }

            if (isset($result[0]['rom_product_detail']) && $result[0]['rom_product_detail'] != "") {
                $data['product'] += ['rom_product_detail' => $result[0]['rom_product_detail']];
            }

            if (isset($result[0]['battery_product_detail']) && $result[0]['battery_product_detail'] != "") {
                $data['product'] += ['battery_product_detail' => $result[0]['battery_product_detail']];
            }


            $this->load->view('home/detail', $data);
        } else {
            $this->load->view('home/index');
        }
    }

    public function showProductByCategory($id)
    {
        Session::init();

        $productModel = $this->load->model('productModel');
        //lấy dữ liệu
        $table_product = 'product';
        $result = $productModel->productbyidCategory($table_product, $id);

        if ($result != null) {
            $ds_sp = [];
            foreach ($result as $key => $value) {
                $ds_sp[] = array(
                    'id_product' => $value['id_product'],
                    'title_product' => $value['title_product'],
                    'price_product' => $value['price_product'],
                    'old_price_product' => $value['old_price_product'],
                    'quantity_product' => $value['quantity_product'],
                    'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                    'id_category_product' => $value['id_category_product'],
                    'title_category_product' => $value['title_category_product'],
                    'id_product_producer' => $value['id_product_producer'],
                    'title_product_producer' => $value['title_product_producer']
                );
            }

            $data['product'] = $ds_sp;

            switch ($id) {
                case 3: //điện thoại
                    $this->load->view('home/dienthoai', $data);
                    break;
                case 2: //laptop
                    $this->load->view('home/laptop', $data);
                    break;
                case 1: //tablet
                    $this->load->view('home/tablet', $data);
                    break;
                case 4: //Phụ kiện
                    $this->load->view('home/phukien', $data);
                    break;
                case 8: //Đồng hồ thông minh
                    $this->load->view('home/dongho', $data);
                    break;

                default:
                    $this->load->view('home/index');
                    break;
            }
        } else {
            $this->load->view('home/index');
        }
    }

    public function search()
    {
        Session::init();

        $key = $_POST['timkiem'];

        $productModel = $this->load->model('productModel');
        //lấy dữ liệu
        $table_product = 'product';
        $result = $productModel->productByKey($table_product, $key);

        if ($result != null) {
            $ds_sp = [];
            foreach ($result as $key => $value) {
                $ds_sp[] = array(
                    'id_product' => $value['id_product'],
                    'title_product' => $value['title_product'],
                    'price_product' => $value['price_product'],
                    'old_price_product' => $value['old_price_product'],
                    'quantity_product' => $value['quantity_product'],
                    'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                    'id_category_product' => $value['id_category_product'],
                    'title_category_product' => $value['title_category_product'],
                    'id_product_producer' => $value['id_product_producer'],
                    'title_product_producer' => $value['title_product_producer']
                );
            }

            $data['product'] = $ds_sp;
            $data['key'] = $key;
            $this->load->view('home/timkiem', $data);
        } else {
            $this->load->view('home/index');
        }
    }
}
