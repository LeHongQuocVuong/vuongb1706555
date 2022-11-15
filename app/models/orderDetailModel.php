<?php
class orderDetailModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function orderDetail($table)
    {
        $sql = "SELECT * FROM $table ORDER BY id_order DESC";
        return $this->db->select($sql);
    }

    public function orderDetailbyMaDonHang($table_order, $dh_ma)
    {
        $sql = "SELECT * FROM $table_order WHERE dh_ma=:dh_ma";

        $sql = <<<EOT
        SELECT od.id_product, od.dh_ma, od.od_soluong, od.od_dongia,
            sp.id_product, sp.title_product, sp.price_product, sp.old_price_product,
			sp.short_desc_product, sp.long_desc_product, sp.created_product,
			sp.quantity_product, sp.image_product, 
			img.id_product_image, img.name_product_image
        FROM order_detail AS od
        JOIN product AS sp ON od.id_product = sp.id_product
        LEFT JOIN product_image AS img ON sp.id_product = img.id_product
        WHERE od.dh_ma=:dh_ma
		  ORDER BY sp.id_product ASC;
EOT;

        $data = array(':dh_ma' => $dh_ma);

        return $this->db->select($sql, $data);
    }

    public function productbyidForOrderDetail($table_product, $id)
    {
        $sql = <<<EOT
        SELECT sp.id_product, sp.title_product, sp.price_product, sp.old_price_product,
			sp.short_desc_product, sp.long_desc_product, sp.created_product,
			sp.quantity_product, sp.image_product, 
			lsp.id_category_product, lsp.title_category_product, lsp.desc_category_product,
			nsx.id_product_producer, nsx.title_product_producer, .nsx.desc_product_producer,
			img.id_product_image, img.name_product_image
        FROM product AS sp
        JOIN category_product AS lsp ON sp.id_category_product = lsp.id_category_product
        JOIN product_producer AS nsx ON sp.id_product_producer = nsx.id_product_producer
        LEFT JOIN product_image AS img ON sp.id_product = img.id_product
        WHERE sp.id_product=:id
		  ORDER BY sp.id_product ASC;
EOT;
        // $sql = "SELECT * FROM $table_product WHERE id_product=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function insertorderDetail($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function updateorderDetail($table, $data, $cond)
    {
        return $this->db->update($table, $data, $cond);
    }

    public function deleteorderDetail($table, $cond)
    {
        return $this->db->deleteAll($table, $cond);
    }
}
