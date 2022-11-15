<?php
class productDetailModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function product_detail($table)
    {
        $sql = "SELECT * FROM $table ORDER BY id_product_detail DESC";
        return $this->db->select($sql);
    }

    public function product_detailbyid($table_product_detail, $id)
    {
        $sql = "SELECT * FROM $table_product_detail WHERE id_product_detail=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function product_detailbyidproduct($table_product_detail, $id)
    {
        $sql = "SELECT * FROM $table_product_detail WHERE id_product=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function insertproduct_detail($table_product_detail, $data)
    {
        return $this->db->insert($table_product_detail, $data);
    }

    public function insert_product_detail_return_id($table_product, $data)
    {
        return $this->db->insert_return_id($table_product, $data);
    }

    public function updateproduct_detail($table_product_detail, $data, $cond)
    {
        return $this->db->update($table_product_detail, $data, $cond);
    }

    public function deleteproduct_detail($table_product_detail, $cond)
    {
        return $this->db->delete($table_product_detail, $cond);
    }
}
