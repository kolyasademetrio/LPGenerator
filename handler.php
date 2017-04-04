<?php
include_once 'functions.php';

$id = trim($_POST['id']);

$POST_arr = $_POST;

myvardump($_FILES);

unset($POST_arr['id']);
unset($POST_arr['submit']);




foreach ($POST_arr as $key_POST_arr => $value_POST_arr) {

	if ( empty($POST_arr[$key_POST_arr]) || trim($POST_arr[$key_POST_arr]) == '') {
		unset( $POST_arr[$key_POST_arr] );
	}

}

$db = new Database();

$db->update_tablecell_value($POST_arr, $id);















header('Location: index.php#' . $id);
exit;


 



