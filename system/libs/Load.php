<?php
class Load   //load view, model
{
    public function __construct()
    {
    }

    public function view($fileName, $data = array())
    {
        if ($data == true) {
            extract($data);
        }
        include 'app/views/' . $fileName . '.php'; //chạy từ trang index.php ở ngoài nên đường dẫn chỉ cần ntn là đủ
    }

    public function model($fileName)
    {
        include 'app/models/' . $fileName . '.php'; //chạy từ trang index.php ở ngoài nên đường dẫn chỉ cần ntn là đủ
        return new $fileName();
    }
}
