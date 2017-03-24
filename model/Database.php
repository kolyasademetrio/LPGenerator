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





    /*
    * получаем массив из имен всех таблиц в нашей базе данных
    *
    */
    private function get_all_tablename_DB_arr()
    {
        $res = $this->db->query('SHOW TABLES');

        return array_column( mysqli_fetch_all($res), 0 );
    }


    
    public function getNumRow($POSTarr, $id) {

        // получаем массив $tablesList из именамин всех таблиц в нашей базе данных
        $tables_list_arr = $this->get_all_tablename_DB_arr();

    	foreach ($tables_list_arr as $table_name) {

            // echo 'START of the table: ' . $table_name . '<br>';

            foreach ($POSTarr as $key => $value) {

               if ($stmt = $this->db->prepare("SELECT $key FROM $table_name WHERE id=$id")) {

                    $stmt->execute();
                    $stmt->store_result();
                    if ( $stmt->num_rows() ) {

                        $st = $this->db->prepare("UPDATE $table_name SET $key=? WHERE id=$id");

                        $st->bind_param('s', $value);

                        $st->execute();

                    }
                
                }

            }

            // echo 'END of the table: ' . $table_name . '<br><hr>';

    	}

    } 

}