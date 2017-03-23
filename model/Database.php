<?php include_once 'config.php';

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

    	foreach ($POSTarr as $key => $value) {

    		echo '$key - ' . $key . '<br>';

    		$result = mysqli_query($this->db, "SELECT * FROM html_content");

    		 if ($row = mysqli_fetch_assoc($result)) {
            echo $row['title'];
        } else {
            return $default;
        }
    		
    	}

  //   	$query = "SELECT * FROM products ORDER BY price DESC LIMIT 3";
		// $data = mysql_gettable($query);
		// print_r($data);
    } 

}