<?php
class Expense
{
    public $que;
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'Expense';
    private $result = array();
    private $mysqli = '';
    public $sql;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function insertShopping($table, $para = array())
    {
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql = "INSERT INTO $table($table_columns) VALUES('$table_value')";

        $result = $this->mysqli->query($sql);

        $insert_id = $this->mysqli->insert_id;

        return $insert_id;
    }

    public function insertItems($table, $para = array())
    {
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql = "INSERT INTO $table($table_columns) VALUES('$table_value')";

        $result = $this->mysqli->query($sql);
    }

    public function update($table, $para = array(), $id)
    {
        $args = array();

        foreach ($para as $key => $value) {
            $args[] = "$key = '$value'";
        }

        $sql = "UPDATE  $table SET " . implode(',', $args);

        $sql .= " WHERE $id";

        $result = $this->mysqli->query($sql);
    }

    public function deleteShopping($table, $id)
    {
        $sql = "DELETE FROM $table";
        $sql .= " WHERE $id ";
        print_r($sql);
        $result = $this->mysqli->query($sql);
    }

    public function deleteItems($table, $id)
    {
        $sql = "DELETE FROM $table";
        $sql .= " WHERE $id ";
        $sql;
        $result = $this->mysqli->query($sql);
    }

    public function select($where = null)
    {
        if ($where != null) {
            $sql = "SELECT s.shopping_code
                , s.shopping_category
                , s.shopping_date
                , i.item_code
                , i.item_name
                , i.item_category
                , i.item_description
                , i.item_qty
                , i.price
                , i.total_price
                FROM items i 
                LEFT JOIN shopping s 
                ON i.shopping_code = s.shopping_code
                WHERE $where";
        } else {
            $sql = "SELECT s.shopping_code
                , s.shopping_category
                , s.shopping_date
                , i.item_code
                , i.item_name
                , i.item_category
                , i.item_description
                , i.item_qty
                , i.price
                , i.total_price
                FROM items i 
                LEFT JOIN shopping s 
                ON i.shopping_code = s.shopping_code";
        }

        $this->sql = $this->mysqli->query($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}
