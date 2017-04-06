<?php
include_once 'functions.php';
// include_once 'model/Database.php';

$id = trim($_POST['id']);

$POST_arr = $_POST;

if (!empty($_FILES)) {
	// echo '<pre>';
	// var_dump($_POST);
	// echo '</pre>';
	// myvardump($_FILES);

	$i = 1;
	foreach ($_FILES as $files) {
		if ($files['error'] == false) {
			$db = new Database();
			$new_sect_name = trim($_POST['sect_name']);
			$old_sect_name = $db->get_val('section_name', $_POST['id'], 'default', 'html_content');

			echo $new_sect_name . '<br>';
			echo $old_sect_name . '<br>';
			die();


			$uploaddir = getcwd() . DIRSEP . 'templates' . DIRSEP . 'images' . DIRSEP . $POST_arr['sect_name'] . DIRSEP;

			$filename = $POST_arr['sect_name'] . '_' . $i . '.' . get_extension($files['name']);

			if ( !is_dir($uploaddir) ) mkdir($uploaddir);

			$uploadfile = $uploaddir . $filename;

			move_uploaded_file($files['tmp_name'], $uploadfile);
		}
		
		$i++;
	}

	// $uploaddir = getcwd().DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;
	// $uploadfile = $uploaddir.basename($_FILES['col_image']['name']);

	// move_uploaded_file($_FILES['col_image']['tmp_name'], $uploadfile);
}



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


 



