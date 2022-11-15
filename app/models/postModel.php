<?php
class postModel extends dModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function post($table)
    {
        $sql = <<<EOT
            SELECT post.id_post, post.title_post, post.desc_post, post.image_name_post, post.created_post,
    			lpost.id_post_category, lpost.title_post_category, lpost.desc_post_category
            FROM post AS post
            JOIN post_category AS lpost ON post.id_post_category = lpost.id_post_category
            ORDER BY post.id_post ASC;
    EOT;
        // $sql = "SELECT * FROM $table ORDER BY id_post DESC";
        return $this->db->select($sql);
    }

    public function postbyid($table_post, $id)
    {
        $sql = <<<EOT
            SELECT post.id_post, post.title_post, post.desc_post, post.image_name_post, post.created_post,
    			lpost.id_post_category, lpost.title_post_category, lpost.desc_post_category
            FROM post AS post
            JOIN post_category AS lpost ON post.id_post_category = lpost.id_post_category
            WHERE post.id_post=:id
    		  ORDER BY post.id_post ASC;
    EOT;
        // $sql = "SELECT * FROM $table_post WHERE id_post=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function postbyPostCateId($table_post, $id)
    {
        $sql = <<<EOT
            SELECT post.id_post, post.title_post, post.desc_post, post.image_name_post, post.created_post,
    			lpost.id_post_category, lpost.title_post_category, lpost.desc_post_category
            FROM post AS post
            JOIN post_category AS lpost ON post.id_post_category = lpost.id_post_category
            WHERE lpost.id_post_category=:id
    		  ORDER BY post.id_post;
    EOT;
        // $sql = "SELECT * FROM $table_post WHERE id_post=:id";

        $data = array(':id' => $id);

        return $this->db->select($sql, $data);
    }

    public function insertpost($table_post, $data)
    {
        return $this->db->insert($table_post, $data);
    }

    public function insert_post_return_id($table_post, $data)
    {
        return $this->db->insert_return_id($table_post, $data);
    }

    public function updatepost($table_post, $data, $cond)
    {
        return $this->db->update($table_post, $data, $cond);
    }

    public function deletepost($table_post, $cond)
    {
        return $this->db->delete($table_post, $cond);
    }
}
