<?php
class postCategoryModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function category($table)
    {
        $sql = "SELECT * FROM $table ORDER BY id_post_category";
        return $this->db->select($sql);
    }

    public function categorybyid($table_post_category, $id)
    {
        $sql = "SELECT * FROM $table_post_category WHERE id_post_category=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function insertcategory($table_post_category, $data)
    {
        return $this->db->insert($table_post_category, $data);
    }

    public function updatecategory($table_post_category, $data, $cond)
    {
        return $this->db->update($table_post_category, $data, $cond);
    }

    public function deletecategory($table_post_category, $cond)
    {
        return $this->db->delete($table_post_category, $cond);
    }
}
