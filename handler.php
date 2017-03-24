<?php

include_once 'functions.php';

$id = trim($_POST['id']);

$POSTarr = $_POST;
unset($POSTarr['id']);
unset($POSTarr['submit']);

foreach ($POSTarr as $keyPOSTarr => $valuePOSTarr) {
	if ( empty($POSTarr[$keyPOSTarr]) || trim($POSTarr[$keyPOSTarr]) == '') {
		unset( $POSTarr[$keyPOSTarr] );
	}
}

$db = new Database();

$db->getNumRow($POSTarr, $id);


// echo '<pre>';
// var_dump($POSTarr);
// echo '</pre><br>';

// echo $id;
// die();












header('Location: index.php');
exit;


 



