<?php

include_once 'functions.php';

$id = trim($_POST['id']);

$POSTarr = $_POST;



unset($POSTarr['id']);
unset($POSTarr['submit']);





$db = new Database();

$db->getNumRow($POSTarr, $id);

die;


// echo '<pre>';
// var_dump($POSTarr);
// echo '</pre><br>';

// echo $id;
// die();

// 'UPDATE mytable SET column1 = value1, column2 = value2 WHERE key_value = some_value'




// echo $id;
// die;



// array(7) {
//   ["section_name"]=>
//   string(4) "name"
//   ["section_padding_top"]=>
//   string(11) "padding top"
//   ["section_padding_bottom"]=>
//   string(14) "padding bottom"
//   ["border_width"]=>
//   string(6) "border"
//   ["title"]=>
//   string(5) "title"
//   ["id"]=>
//   string(1) "1"
//   ["submit"]=>
//   string(25) "Изменить блок"
// }




// if (isset($_POST['name'])) {
// 	echo $_POST['name'];
// }







header('Location: index.php');
exit;


 



