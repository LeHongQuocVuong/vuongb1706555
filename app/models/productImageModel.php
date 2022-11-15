<?php
class productImageModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function product_image($table)
    {
        $sql = "SELECT * FROM $table ORDER BY id_product_image DESC";
        return $this->db->select($sql);
    }

    public function product_imagebyid($table_product_image, $id)
    {
        $sql = "SELECT * FROM $table_product_image WHERE id_product_image=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function product_imagebyidproduct($table_product_image, $id)
    {
        $sql = "SELECT * FROM $table_product_image WHERE id_product=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function insertproduct_image($table_product_image, $data)
    {
        return $this->db->insert($table_product_image, $data);
    }

    public function updateproduct_image($table_product_image, $data, $cond)
    {
        return $this->db->update($table_product_image, $data, $cond);
    }

    public function deleteproduct_image($table_product_image, $cond)
    {
        return $this->db->delete($table_product_image, $cond);
    }
}
