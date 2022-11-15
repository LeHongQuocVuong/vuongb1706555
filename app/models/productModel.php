<?php
class productModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //lấy product ko join với các bản khác
    public function getProductNormal($table)
    {
        $sql = "SELECT * FROM $table ORDER BY id_product DESC";
        return $this->db->select($sql);
    }

    public function product($table)
    {
        $sql = <<<EOT
        SELECT sp.id_product, sp.title_product, sp.price_product, sp.old_price_product,
			sp.short_desc_product, sp.long_desc_product, sp.created_product,
			sp.quantity_product, sp.image_product, 
			lsp.id_category_product, lsp.title_category_product, lsp.desc_category_product,
			nsx.id_product_producer, nsx.title_product_producer, .nsx.desc_product_producer,
			img.id_product_image, img.name_product_image,
			detail.id_product_detail, detail.display_product_detail, detail.os_product_detail,
			detail.main_camera_product_detail, detail.selfie_camera_product_detail,
			detail.cpu_product_detail, detail.ram_product_detail, detail.rom_product_detail, detail.battery_product_detail,
			km.id_sale, km.title_sale, km.desc_sale, km.start_sale, km.end_sale
        FROM product AS sp
        JOIN category_product AS lsp ON sp.id_category_product = lsp.id_category_product
        JOIN product_producer AS nsx ON sp.id_product_producer = nsx.id_product_producer
        LEFT JOIN product_image AS img ON sp.id_product = img.id_product
        LEFT JOIN product_detail AS detail ON sp.id_product = detail.id_product
        LEFT JOIN sale AS km on sp.id_sale = km.id_sale
		  ORDER BY sp.id_product ASC;
EOT;
        // $sql = "SELECT * FROM $table ORDER BY id_product DESC";
        return $this->db->select($sql);
    }

    public function productbyid($table_product, $id)
    {
        $sql = <<<EOT
        SELECT sp.id_product, sp.title_product, sp.price_product, sp.old_price_product,
			sp.short_desc_product, sp.long_desc_product, sp.created_product,
			sp.quantity_product, sp.image_product, 
			lsp.id_category_product, lsp.title_category_product, lsp.desc_category_product,
			nsx.id_product_producer, nsx.title_product_producer, .nsx.desc_product_producer,
			img.id_product_image, img.name_product_image,
			detail.id_product_detail, detail.display_product_detail, detail.os_product_detail,
			detail.main_camera_product_detail, detail.selfie_camera_product_detail,
			detail.cpu_product_detail, detail.ram_product_detail, detail.rom_product_detail, detail.battery_product_detail,
			km.id_sale, km.title_sale, km.desc_sale, km.start_sale, km.end_sale
        FROM product AS sp
        JOIN category_product AS lsp ON sp.id_category_product = lsp.id_category_product
        JOIN product_producer AS nsx ON sp.id_product_producer = nsx.id_product_producer
        LEFT JOIN product_image AS img ON sp.id_product = img.id_product
        LEFT JOIN product_detail AS detail ON sp.id_product = detail.id_product
        LEFT JOIN sale AS km on sp.id_sale = km.id_sale
        WHERE sp.id_product=:id
		  ORDER BY sp.id_product ASC;
EOT;
        // $sql = "SELECT * FROM $table_product WHERE id_product=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function productbyidCategory($table_product, $id, $limit = 0)
    {
        if ($limit != 0) {
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
        WHERE sp.id_category_product=:id
		  ORDER BY sp.id_product ASC
          LIMIT $limit;
EOT;
        } else {
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
        WHERE sp.id_category_product=:id
		  ORDER BY sp.id_product ASC;
EOT;
        }

        // $sql = "SELECT * FROM $table_product WHERE id_product=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function productByKey($table, $key)
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
        WHERE sp.title_product LIKE '%$key%'
		  ORDER BY sp.id_product ASC;
EOT;
        // $sql = "SELECT * FROM $table ORDER BY id_product DESC";
        return $this->db->select($sql);
    }

    public function insertproduct($table_product, $data)
    {
        return $this->db->insert($table_product, $data);
    }

    public function insert_product_return_id($table_product, $data)
    {
        return $this->db->insert_return_id($table_product, $data);
    }

    public function updateproduct($table_product, $data, $cond)
    {
        return $this->db->update($table_product, $data, $cond);
    }

    public function deleteproduct($table_product, $cond)
    {
        return $this->db->delete($table_product, $cond);
    }
}
