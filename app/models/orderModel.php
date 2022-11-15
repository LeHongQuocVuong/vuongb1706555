<?php
class orderModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function order($table)
    {
        $sql = <<<EOT
        SELECT dh.dh_ma, dh.dh_tongtien, dh.dh_ngaylap, dh.dh_ngaygiao,
			dh.dh_noigiao, dh.dh_trangthaithanhtoan, dh.httt_ma,
			dh.kh_tendangnhap, 
			httt.httt_ma, httt.httt_ten, httt.httt_desc,
            kh.kh_tendangnhap, kh.kh_ten, kh.kh_gioitinh,
            kh.kh_diachi, kh.kh_dienthoai, kh.kh_email,
            kh.kh_ngaysinh, kh.kh_cccd
        FROM `order` AS dh
        JOIN hinhthucthanhtoan AS httt ON dh.httt_ma = httt.httt_ma
        JOIN customer AS kh ON dh.kh_tendangnhap = kh.kh_tendangnhap
		  ORDER BY dh.dh_ma ASC;
EOT;
        return $this->db->select($sql);
    }

    public function orderbyid($table_order, $id)
    {
        $sql = <<<EOT
        SELECT dh.dh_ma, dh.dh_tongtien, dh.dh_ngaylap, dh.dh_ngaygiao,
			dh.dh_noigiao, dh.dh_trangthaithanhtoan, dh.httt_ma,
			dh.kh_tendangnhap, 
			httt.httt_ma, httt.httt_ten, httt.httt_desc
        FROM `order` AS dh
        JOIN hinhthucthanhtoan AS httt ON dh.httt_ma = httt.httt_ma
        WHERE dh.dh_ma=:id
		  ORDER BY dh.dh_ma ASC;
EOT;

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function orderByUser($table_order, $kh_tendangnhap)
    {
        $sql = "SELECT * FROM `$table_order` WHERE kh_tendangnhap=:kh_tendangnhap";

        $data = array(':kh_tendangnhap' => $kh_tendangnhap);

        return $this->db->select($sql, $data);
    }

    public function insertorder($table_order, $data)
    {
        return $this->db->insert($table_order, $data);
    }

    public function insert_order_return_id($table_product, $data)
    {
        return $this->db->insert_return_id($table_product, $data);
    }

    public function updateorder($table_order, $data, $cond)
    {
        return $this->db->update($table_order, $data, $cond);
    }

    public function deleteorder($table_order, $cond)
    {
        return $this->db->delete($table_order, $cond);
    }
}
