<?php
class login extends dController
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
        $this->login();
    }

    public function login()
    {
        // Session::checkSession(); //Kiểm tra đã đăng nhập rồi thì chuyển vào dashboard
        Session::init();
        if (Session::get("login") == true) {
            header("Location:" . BASE_URL . "login/dashboard");
        }

        $this->load->view('admin/login');
    }

    public function dashboard()
    {

        Session::checkSession(); //Kiểm tra đã đăng nhập rồi mới cho vào
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    public function authentication_login()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $table = "user";
        $loginModel = $this->load->model('loginModel');

        $count = $loginModel->login($table, $username, $password);

        if ($count == 0) {
            $message['msg'] = "Username hoặc mật khẩu sai";
            header("Location:" . BASE_URL . "login");
        } else {
            $result = $loginModel->getLogin($table, $username, $password);

            //Lưu session
            Session::init();
            Session::set("login", true);
            Session::set("username", $result[0]['username']);
            Session::set("id_user", $result[0]['id_user']);
            Session::set("type_user", $result[0]['type_user']);

            header("Location:" . BASE_URL . "login/dashboard");
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        header("Location:" . BASE_URL . "login");
    }
}
