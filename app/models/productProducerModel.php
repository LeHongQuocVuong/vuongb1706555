<?php
class productProducerModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function product_producer($table)
    {
        $sql = "SELECT * FROM $table ORDER BY id_product_producer DESC";
        return $this->db->select($sql);
    }

    public function product_producerbyid($table_product_producer, $id)
    {
        $sql = "SELECT * FROM $table_product_producer WHERE id_product_producer=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function insertproduct_producer($table_product_producer, $data)
    {
        return $this->db->insert($table_product_producer, $data);
    }

    public function updateproduct_producer($table_product_producer, $data, $cond)
    {
        return $this->db->update($table_product_producer, $data, $cond);
    }

    public function deleteproduct_producer($table_product_producer, $cond)
    {
        return $this->db->delete($table_product_producer, $cond);
    }
}
