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

    public function do_query($query)
    {
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    public function get_val($val_name, $id, $default, $table_name)
    {

        // $stmt = $this->db->prepare("SELECT ? FROM ? WHERE id=?");
        // $stmt->bind_param('s', $val_name, $table_name, $id);
        // $stmt->execute();
        // echo !$stmt->bind_result($val_name);

        // while ($stmt->fetch()) {
        //     echo $val_name;
        // }

        $result = mysqli_query($this->db, "SELECT $val_name FROM $table_name WHERE id='$id'");
        if ($row = mysqli_fetch_assoc($result)) {
            return $row[$val_name];
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


    
    public function update_tablecell_value($POST_arr, $id) {
        // получаем массив $tablesList с именами всех таблиц в нашей базе данных
        $tables_list_arr = $this->get_all_tablename_DB_arr();

    	foreach ($tables_list_arr as $table_name) {

            foreach ($POST_arr as $key => $value) {

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
    	}
    } 




}