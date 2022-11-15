<?php
class loginModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE username=? AND password=? AND status_user=1";
        return $this->db->affectedRows($sql, $username, $password);
    }

    public function getLogin($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE username=? AND password=? AND status_user=1";
        return $this->db->selectUser($sql, $username, $password);
    }
}
