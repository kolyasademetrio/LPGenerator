<?php
include_once 'functions.php';
// include_once 'model/Database.php';

$id = trim($_POST['id']);

$POST_arr = $_POST;


// сначала проверка и обработка класса секции - потом ниже загрузка картинки в переименованную папку
if ( !empty($_POST['section_name']) ) {

	$old_section_name = trim($_POST['global_arr_name']);
	$old_section_name =${$old_section_name}['section_name'];


	$new_section_name = trim($_POST['section_name']);


	$path = ROOT . DIRSEP . 'images' . DIRSEP;

	$path_dir = $path . $old_section_name . DIRSEP;


	if ( !is_dir($path_dir) ) mkdir($path_dir);

	$path_dir .= 'photos' . DIRSEP;

	if ( !is_dir($path_dir) ) mkdir($path_dir);

	if ($new_section_name != $old_section_name) {
		
		if ( is_dir($path_dir) ) {
			$handle = opendir($path_dir);

			while (false !== ($file_name = readdir($handle))) {

				if (is_file($path_dir . DIRSEP . $file_name)) {

					$file = pathinfo($file_name);

					// расширение файла
					$file_extension = $file['extension'];

					$array_extension = array('jpeg', 'jpg', 'png');

					if ( in_array($file_extension, $array_extension) ) {

						// полное имя файла с расширением
						$file_basename = $file['basename'];

						// имя файла без расширения и точки перед ним
						$file_without_extension_less = basename($file_basename, '.' . $file_extension);

						// позиция последнего нижнего подчёркивания в имени файла без расширения
						$strripos = strripos($file_without_extension_less, '_');

						// часть имени файла до последнего подчёркивания
						// если имя файла partners_1, то $shortname = "partners"
						$shortname = substr($file_without_extension_less, 0, $strripos);

						// часть имени файла включает подчёркивание и цифру перед расширением
						// если имя файла partners_1, то $number_of_file = "_1"
						$number_of_file = substr($file_without_extension_less, $strripos);


						$new_file_name = $new_section_name . $number_of_file . '.' . $file_extension;
						rename ($path_dir .  DIRSEP . $file_name, $path_dir .  DIRSEP . $new_file_name);
					}
				}
			}

			closedir($handle);
		}

		// переименовываем папку с картинками в которой переименовали все картинки
		
		rename($path . $old_section_name, $path . $new_section_name);
		$db = new Database();
		$db->update_tablecell_value_single('section_name', $new_section_name, $id, 'html_content');
	}
}



if (!empty($_FILES)) {
	// echo '<pre>';
	// var_dump($_POST);
	// echo '</pre>';
	// myvardump($_FILES);

	$i = 1;
	foreach ($_FILES as $files) {
		if ($files['error'] == false) {

			if ( !empty($_POST['section_name']) ) {
				$section_img_name = trim($_POST['section_name']);
			} else {
				$section_img_name = trim($_POST['global_arr_name']);
				$section_img_name =${$section_img_name}['section_name'];
			}

			$uploaddir = ROOT . DIRSEP . 'images' . DIRSEP . $section_img_name . DIRSEP;

			if ( !is_dir($uploaddir) ) mkdir($uploaddir);

			$uploaddir .= 'photos' . DIRSEP;

			if ( !is_dir($uploaddir) ) mkdir($uploaddir);

			$upploaddir_files_arr = clean_dots_scandir($uploaddir);

			foreach ($upploaddir_files_arr as $upploaddir_file_existing) {

				$needle = '_' . $i . '.';
				if ( strpos($upploaddir_file_existing, $needle) ) {

					unlink($uploaddir . $upploaddir_file_existing);
				}
			}

			$upload_file_extension = get_extension($files['name']);

			$filename = $section_img_name . '_' . $i . '.' . get_extension($files['name']);

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