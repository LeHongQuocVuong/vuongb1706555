<?php
class hinhthucthanhtoanModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function hinhthucthanhtoan($table)
    {
        $sql = "SELECT * FROM $table ORDER BY httt_ma DESC";
        return $this->db->select($sql);
    }

    public function hinhthucthanhtoanbyid($table_hinhthucthanhtoan, $id)
    {
        $sql = "SELECT * FROM $table_hinhthucthanhtoan WHERE httt_ma=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function inserthinhthucthanhtoan($table_hinhthucthanhtoan, $data)
    {
        return $this->db->insert($table_hinhthucthanhtoan, $data);
    }

    public function updatehinhthucthanhtoan($table_hinhthucthanhtoan, $data, $cond)
    {
        return $this->db->update($table_hinhthucthanhtoan, $data, $cond);
    }

    public function deletehinhthucthanhtoan($table_hinhthucthanhtoan, $cond)
    {
        return $this->db->delete($table_hinhthucthanhtoan, $cond);
    }
}
