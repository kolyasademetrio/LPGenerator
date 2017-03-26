<?php

include_once 'functions.php';

$id = trim($_POST['id']);

$POST_arr = $_POST;


unset($POST_arr['id']);
unset($POST_arr['submit']);

// myvardump($POST_arr);

// if ($_POST['block_selected'] == 'selected') {

// 	echo 'Проверка на чекбокс временно в handler.php';
// 	myvardump($_POST['block_selected']);
// }
session_start();
foreach ($_POST as $key => $value) {
	$_SESSION[$key] = $_POST[$key];
}



foreach ($POST_arr as $key_POST_arr => $value_POST_arr) {

	if ( empty($POST_arr[$key_POST_arr]) || trim($POST_arr[$key_POST_arr]) == '') {
		unset( $POST_arr[$key_POST_arr] );
	}

}

$db = new Database();

$db->update_tablecell_value($POST_arr, $id);















header('Location: index.php');
exit;


 



