<?php
include_once 'functions.php';
include_once 'config.php';

class Database
{
	private $host = HOST;
    private $user = USER;
    private $pass = PASS;
    private $database = DATABASE;
    private $db = NULL;
    private $sl = NULL;
    public $result = NULL;
    public $query = NULL;
    
    public function __construct()
    {
        $this->db = new mysqli(HOST, USER, PASS, DATABASE);
        if(!$this->db){
            echo "Невозможно установить соединение с базой данных<br/>Код ошибки:<br/>";
        	exit(mysql_error());
        }
        else
        {
        	mysqli_set_charset($this->db, 'utf8');
        }
        
    }

    public function doQuery($query)
    {
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    public function getVal($valName, $id, $default, $tableName)
    {
        $result = mysqli_query($this->db, "SELECT $valName FROM $tableName WHERE id=$id");
        if ($row = mysqli_fetch_assoc($result)) {
            return $row[$valName];
        } else {
            return $default;
        }
    }

    // 'UPDATE mytable SET column1 = value1, column2 = value2 WHERE key_value = some_value'

    // public function updateValuesOfTable($POSTarr)
    // {
    // 	foreach ($POSTarr as $key => $value) {
    // 		mysqli_query($this->db, "UPDATE mytable SET column1 = value1, column2 = value2 WHERE key_value = some_value");
    // 	}
    // }
    
    public function getNumRow($POSTarr, $id) {

        $tablesList = array_column( mysqli_fetch_all($this->db->query('SHOW TABLES')), 0 );

        // $tablesList = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE 'lpgenerator'");

        var_dump($tablesList);

        die;

    	foreach ($POSTarr as $key => $value) {

    		if ($stmt = $this->db->prepare("SELECT $key FROM css_content WHERE id=$id")) {

                $stmt->execute();
                $stmt->store_result();
                $num_rows = $stmt->num_rows();

                echo $num_rows . '<br>';
                // exit;
            }

    	}

    } 

}