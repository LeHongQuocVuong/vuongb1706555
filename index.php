
    <?php

    //include file config
    include_once 'app/config/config.php';

    //include tất cả các file có trong thư mục system/libs 
    // include_once('system/libs/main.php');
    // include_once('system/libs/dController.php');
    // include_once('system/libs/dModel.php');
    // include_once('system/libs/Database.php');
    // include_once('system/libs/Load.php');    
    spl_autoload_register(function ($class) {
        include_once 'system/libs/' . $class . '.php';
    });

    $main = new Main();

    // // http://localhost/phpstore/index.php?url=product/chitietsanpham/18/samsung-1
    // $url = isset($_GET['url']) ? $_GET['url'] : NULL;

    // //Nếu có $_GET['url']
    // if ($url != null) {
    //     $url = rtrim($url, '/'); //bỏ dấu / ở cuối
    //     $url = explode("/", filter_var($url, FILTER_SANITIZE_URL)); //cắt chuỗi có dấu / ra thành 1 mảng, bắt buộc chuỗi này phải là URL
    // } else {
    //     unset($url);    //ko có $_GET['url'] thì huỷ bỏ biến $url
    // }

    // if (isset($url[0])) { //$url[0] là tên class
    //     include_once('app/controllers/' . $url[0] . '.php'); //gọi class trong controller
    //     $ctrler = new $url[0]();
    //     if (isset($url[2])) { //$url[2] là parameter truyền vào hàm có tên $url[1]
    //         $ctrler->{$url[1]}($url[2]); //gọi hàm tên $url[1] và truyền vào parameter lấy từ $url[2]
    //     } else { //nếu ko có parameter truyền vào hàm
    //         if (isset($url[1])) { //$url[1] là tên hàm
    //             $ctrler->{$url[1]}(); //gọi hàm $url[1] ko có tham số 
    //         } else {
    //         }
    //     }
    // } else { //nếu ko có tên class thì gọi class index.php
    //     include_once('app/controllers/index.php');
    //     $index = new index();
    //     $index->homepage();
    // }
    ?>
