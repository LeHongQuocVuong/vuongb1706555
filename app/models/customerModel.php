<?php
class customerModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function customer($table)
    {
        $sql = "SELECT * FROM $table";
        return $this->db->select($sql);
    }

    public function login($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE kh_tendangnhap=? AND kh_matkhau=? AND kh_status=1";
        return $this->db->affectedRows($sql, $username, $password);
    }

    public function getLogin($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE kh_tendangnhap=? AND kh_matkhau=? AND kh_status=1";
        return $this->db->selectUser($sql, $username, $password);
    }

    public function customerbyUsername($table, $kh_tendangnhap)
    {
        $sql = "SELECT * FROM $table WHERE kh_tendangnhap=:kh_tendangnhap";

        $data = array(':kh_tendangnhap' => $kh_tendangnhap);

        return $this->db->select($sql, $data);
    }

    public function insertcustomer($table, $data)
    {
        return $this->db->insert($table, $data);
    }
}
