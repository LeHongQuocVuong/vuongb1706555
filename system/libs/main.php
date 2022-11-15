<?php
class Main
{
    // http://localhost/phpstore/index.php?url=product/chitietsanpham/18/samsung-1
    //product là tên controller
    //chitietsanpham là tên function trong product controller
    //18 là param truyền vào function chitietsanpham
    public $url;
    public $controllerName = "index";
    public $methodName = "index";
    public $controllerPath = "app/controllers/";
    public $controller;

    public function __construct()
    {
        $this->getUrl();
        // echo $this->url[0];
        $this->loadController();
        $this->callMethod();

        // echo $this->methodName;
    }

    public function getUrl()
    {
        // http://localhost/phpstore/index.php?url=product/chitietsanpham/18/samsung-1
        $this->url = isset($_GET['url']) ? $_GET['url'] : NULL;

        //Nếu có $_GET['url']
        if ($this->url != null) {
            $this->url = rtrim($this->url, '/'); //bỏ dấu / ở cuối
            $this->url = explode("/", filter_var($this->url, FILTER_SANITIZE_URL)); //cắt chuỗi có dấu / ra thành 1 mảng, bắt buộc chuỗi này phải là URL
        } else {
            unset($this->url);    //ko có $_GET['url'] thì huỷ bỏ biến $url
        }
    }

    public function loadController()
    {
        if (!isset($this->url[0])) {
            //nếu ko có controller trên url thì gọi file app/controllers/index.php
            include $this->controllerPath . $this->controllerName . ".php";
            $this->controller = new $this->controllerName();
            // $this->controller->{$this->methodName}();
        } else {
            //nếu có controller trên url thì gọi file 
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath . $this->controllerName . ".php";
            if (file_exists($fileName)) { //nếu có file controller
                include $fileName;
                // echo $fileName;
                if (class_exists($this->controllerName)) { //nếu có class trong file controller
                    $this->controller = new $this->controllerName();
                } else { //nếu ko có class trong file controller

                }
            } else { //nếu ko có file controller
                header("Location:" . BASE_URL . "index/notfound");
            }
        }
    }

    public function callMethod()
    { //gọi funtion trong controller
        if (isset($this->url[2])) { //nếu có param truyền cho function trong url
            $this->methodName = $this->url[1];
            if (method_exists($this->controller, $this->methodName)) { //nếu có funtion này trong controller
                $this->controller->{$this->url[1]}($this->url[2]);
            } else { ////nếu ko có funtion này trong controller
                header("Location:" . BASE_URL . "index/notfound");
            }
        } else {
            if (isset($this->url[1])) { //nếu có function trong url
                $this->methodName = $this->url[1];
                if (method_exists($this->controller, $this->methodName)) { //nếu có funtion này trong controller
                    $this->controller->{$this->methodName}();
                } else { ////nếu ko có funtion này trong controller
                    header("Location:" . BASE_URL . "index/notfound");
                }
            } else {
                if (!method_exists($this->controller, $this->methodName)) { ////nếu ko có funtion này trong controller
                    header("Location:" . BASE_URL . "index/notfound");
                } else { //nếu có funtion này trong controller
                    $this->controller->{$this->methodName}();
                }
            }
        }
    }
}
