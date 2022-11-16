<?php
class index extends dController
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->homepage();
    }

    public function homepage()
    {
        Session::init();
        // $this->load->view('header');

        //Lấy product
        $productModel = $this->load->model('productModel');
        $table_product = 'product';

        //Tablet
        $resultTablet = $productModel->productbyidCategory($table_product, 1, 6); //id Tablet = 3, limit 6

        $ds_tb = [];
        foreach ($resultTablet as $key => $value) {
            $ds_tb[] = array(
                'id_product' => $value['id_product'],
                'title_product' => $value['title_product'],
                'price_product' => number_format($value['price_product'], 0) . " VNĐ",
                'old_price_product' => number_format($value['old_price_product'], 0) . " VNĐ",
                'quantity_product' => $value['quantity_product'],
                'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                'title_category_product' => $value['title_category_product'],
                'title_product_producer' => $value['title_product_producer']
            );
        }

        $data['tablet'] = $ds_tb;

        //Laptop
        $resultLaptop = $productModel->productbyidCategory($table_product, 2, 6); //id Tablet = 3, limit 6

        $ds_lt = [];
        foreach ($resultLaptop as $key => $value) {
            $ds_lt[] = array(
                'id_product' => $value['id_product'],
                'title_product' => $value['title_product'],
                'price_product' => number_format($value['price_product'], 0) . " VNĐ",
                'old_price_product' => number_format($value['old_price_product'], 0) . " VNĐ",
                'quantity_product' => $value['quantity_product'],
                'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                'title_category_product' => $value['title_category_product'],
                'title_product_producer' => $value['title_product_producer']
            );
        }

        $data['laptop'] = $ds_lt;

        //điện thoại
        $resultDienthoai = $productModel->productbyidCategory($table_product, 3, 6); //id điện thoại = 3, limit 6

        $ds_dt = [];
        foreach ($resultDienthoai as $key => $value) {
            $ds_dt[] = array(
                'id_product' => $value['id_product'],
                'title_product' => $value['title_product'],
                'price_product' => number_format($value['price_product'], 0) . " VNĐ",
                'old_price_product' => number_format($value['old_price_product'], 0) . " VNĐ",
                'quantity_product' => $value['quantity_product'],
                'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                'title_category_product' => $value['title_category_product'],
                'title_product_producer' => $value['title_product_producer']
            );
        }

        $data['dienthoai'] = $ds_dt;

        //Tai nghe
        $resultTainghe = $productModel->productbyidCategory($table_product, 4, 6); //id điện thoại = 3, limit 6

        $ds_tn = [];
        foreach ($resultTainghe as $key => $value) {
            $ds_tn[] = array(
                'id_product' => $value['id_product'],
                'title_product' => $value['title_product'],
                'price_product' => number_format($value['price_product'], 0) . " VNĐ",
                'old_price_product' => number_format($value['old_price_product'], 0) . " VNĐ",
                'quantity_product' => $value['quantity_product'],
                'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                'title_category_product' => $value['title_category_product'],
                'title_product_producer' => $value['title_product_producer']
            );
        }

        $data['tainghe'] = $ds_tn;

        //Đồng hồ
        $resultDongho = $productModel->productbyidCategory($table_product, 8, 6); //id điện thoại = 3, limit 6

        $ds_dh = [];
        foreach ($resultDongho as $key => $value) {
            $ds_dh[] = array(
                'id_product' => $value['id_product'],
                'title_product' => $value['title_product'],
                'price_product' => number_format($value['price_product'], 0) . " VNĐ",
                'old_price_product' => number_format($value['old_price_product'], 0) . " VNĐ",
                'quantity_product' => $value['quantity_product'],
                'name_product_image' => (isset($value['name_product_image']) && $value['name_product_image'] != "") ? BASE_URL . "public/uploads/products/" . $value['name_product_image'] : "",
                'title_category_product' => $value['title_category_product'],
                'title_product_producer' => $value['title_product_producer']
            );
        }

        $data['dongho'] = $ds_dh;


        $this->load->view('home/index', $data);

        // $this->load->view('footer');
    }

    public function notfound()
    {
        $this->homepage();
    }
}
