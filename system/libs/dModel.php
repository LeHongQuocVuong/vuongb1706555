<?php
class dModel   //ket noi CSDL
{
    protected $db = array();

    public function __construct()
    {
        // $connect = 'mysql:dbname=phpstore; host=localhost; charset=utf8';
        $connect = 'mysql:dbname=vuongb1706555; host=localhost';
        $user = 'root';
        $password = '';
        $this->db = new Database($connect, $user, $password);
    }
}
