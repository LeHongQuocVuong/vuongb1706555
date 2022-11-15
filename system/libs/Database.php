<?php
class Database extends PDO   //ket noi CSDL
{

    public function __construct($connect, $user, $password)
    {
        parent::__construct($connect, $user, $password);
        // $db = new PDO($connect, $user, $password);
    }


    public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC)
    {
        $statement = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindParam($key, $value);
        }

        $statement->execute();
        return $statement->fetchAll($fetchStyle);
    }

    public function insert($table, $data = array())
    {
        //title_category_product,desc_category_product
        $keys = implode(",", array_keys($data)); //lấy key của mảng data, thêm dấu "," ở giữa
        //':title_category_product', ':desc_category_product'
        $values = ":" . implode(", :", array_keys($data)); //lấy value của mảng data

        $sql = "INSERT INTO `$table` ($keys) 
                    VALUE($values)";

        $statement = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        return $statement->execute();
    }

    public function insert_return_id($table, $data = array())
    {
        //title_category_product,desc_category_product
        $keys = implode(",", array_keys($data)); //lấy key của mảng data, thêm dấu "," ở giữa
        //':title_category_product', ':desc_category_product'
        $values = ":" . implode(", :", array_keys($data)); //lấy value của mảng data

        $sql = "INSERT INTO `$table` ($keys) 
                    VALUES($values)";

        $statement = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        // echo $sql;
        $statement->execute();
        return $this->lastInsertId(); //trả về id
    }

    public function update($table, $data = array(), $cond)
    {
        $updateKey = NULL;
        foreach ($data as $key => $value) {
            $updateKey .= "$key=:$key,";
        }

        //cắt dấu "," ở cuối
        $updateKey = rtrim($updateKey, ",");

        $sql = "UPDATE `$table` SET $updateKey WHERE $cond";

        $statement = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        return $statement->execute();
    }

    public function delete($table, $cond, $limit = 1)
    {
        $sql = "DELETE FROM $table WHERE $cond LIMIT $limit";
        return $this->exec($sql);
    }

    public function deleteAll($table, $cond)
    {
        $sql = "DELETE FROM $table WHERE $cond";
        return $this->exec($sql);
    }

    //hàm kiểm tra có user trong database ko
    public function affectedRows($sql, $username, $password)
    {
        $statement = $this->prepare($sql);
        $statement->execute(array($username, $password));
        return $statement->rowCount();
    }

    //Lấy user
    public function selectUser($sql, $username, $password)
    {
        $statement = $this->prepare($sql);
        $statement->execute(array($username, $password));

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
