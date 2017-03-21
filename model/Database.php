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

    public function getVal($valName, $id, $default)
    {
        $result = mysqli_query($this->db, "SELECT $valName FROM sections WHERE id=$id");
        if ($row = mysqli_fetch_assoc($result)) {
            return $row[$valName];
        } else {
            return $default;
        }
    }

}