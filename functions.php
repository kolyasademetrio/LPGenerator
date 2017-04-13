<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('FILEEXTENSION_PHP', 'php');
define('FILEEXTENSION_CSS', 'css');
define('FILEEXTENSION_HTML', 'html');
define('DIRSEP', DIRECTORY_SEPARATOR);


/**
 * при создании экземпляра класса(объекта) Database
 * подключает файл с классом из папки model/
 * @param  string $class_name [description]
 * @return [type]            [description]
 */
function __autoload($class_name) {
	$class_name = str_replace('..', '', $class_name);
	require_once "model/$class_name.php";
}

function myvardump($array) {
	echo '<pre>';
	var_dump($array);
	echo '</pre><hr>';
	die();
}


/* 
* array_column — Возвращает массив из значений одного столбца входного массива
* добавляем свою функцию array_column так как испоьзую PHP 5.4 и в этой версии нет этой функции
* использую для подсчёта и вывода всех имен таблиц в базе данных
*/ 
if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}


/**
 * Выводит теги <link rel="stylesheet" href=""></link>
 * с ссылкой на все файлы из директории $dir_name
 * @param  string $dir_name путь к дирректории в формате 'templates/css/css-output/common'
 */
function load_stylesheets( $dir_name ) {

	$files = scandir( $dir_name );

	$files = array_diff($files, array('.', '..'));

	foreach ($files as $file_name) {

		$file_path = $dir_name . DIRSEP . $file_name;

		if ( file_exists($file_path) ) {
			echo '<link rel="stylesheet" href="' . $file_path . '">';
		}
	}
}


/**
 * Возвращает расширение файла
 * @param  string $file_path_name полный путь к файлу с именем и расширением
 * @return string возвращает расширение файла
 */
function get_extension( $file_path_name ) {
    $path_info = pathinfo($file_path_name);
    return $path_info['extension'];
}


/**
 * Получает массив всех файлов в директории. Удаляет из массива точки
 * @param  string $dir_path путь к дирректории в формате 'templates/css/css-output/common'
 * @return Array Возвращает массив всех файлов в дирректории(без точек)
 */
function clean_dots_scandir ($dir_path) {
	$arr_files = scandir( $dir_path );
	$arr_files_cleaned = array_diff($arr_files, array('.', '..'));

	return $arr_files_cleaned;
}


/**
 * Создаёт глобальный массив со всеми переданными переменными
 * имя массива образуется как 'tmpl_' . $id, например: $tmpl_1 или $tmpl_common
 * выходной массив имеет вид: $tmpl_common_css = array('id' => 'common_css', '$width' => 'width');
 * выходной массив имеет вид: $tmpl_1 = array('id' => 1, '$width' => 'width');
 * @param string $id, первый параметр - добавляются в глобальный массив
 * @param array('value',
 *        		'value') все элементы которые надо вывести в админку как input[type="text"] - добавляются в глобальный массив
 * @param array('key' => 'value',
 *              'key' => 'value') все элементы которые надо добавить в глобальную область видимости - добавляются в глобальный массив
 */
function create_array() {

	$args = func_get_args();

	$id = $args[0];

	$arrayName = 'tmpl_' . $id;

	global ${$arrayName};

	${$arrayName}['global_arr_name'] = $arrayName;

	${$arrayName}['id'] = array_shift($args);

	if (is_array($args[0]) && $args[0] !== NULL) {
		foreach ($args[0] as $key => $value) {
			${$arrayName}['$' . $value] = $value;
		}
	}

	if (is_array($args[1]) && $args[1] !== NULL) {
		foreach ($args[1] as $key => $value) {
			${$arrayName}[$key] = $value;
		}
	}

	// for ($i = 0; $i < count($args); $i++) {
	// 	if ( !is_array($args[$i]) ) {
	// 		if ($i > 0) {
	// 			${$arrayName}['$' . $args[$i]] = $args[$i];
	// 		} else {
	// 			${$arrayName}['id'] = $args[$i];
	// 		}
	// 	} else {
	// 		foreach ($args[$i] as $key => $value) {
	// 			${$arrayName}[$key] = $value;
	// 		}
	// 	}
	// }
}


/**
 * Открывает исходные файлы в папке $source_dir берёт то что они возвращают
 * и создаёт файлы css с такими же именами в папке $output_dir.
 * Если файл есть - перезаписывает содержимое.
 * Если файла нет - создает и записывает содержимое.
 * @param  string $source_dir           	путь к исходному файлу в формате 'templates/css/css-source/sections'
 * @param  string $output_dir           	путь к сгенерированному файлу в формате 'templates/css/css-output/sections'
 * @param  string $source_file_extension	расширение исходного файла
 * @param  string $output_file_extension	расширение сгенерированного файла
 */
function generate_output_files($source_dir, $output_dir, $source_file_extension, $output_file_extension) {

	$files_source_array = clean_dots_scandir( $source_dir );
	$files_output_array = clean_dots_scandir( $output_dir );

	foreach($files_source_array as $file_name) {

		$file_path = ROOT . DIRSEP . $source_dir . DIRSEP . $file_name;

		if ( is_dir($file_path) ) {
			array_map('unlink', glob("$file_path/*.*"));
			rmdir($file_path);
			continue;
		}

		$file_extension = get_extension($file_path);

		$name = substr($file_name, 0, strpos($file_name, '.' . $file_extension));

		if ( is_file($file_path) && $file_extension === $source_file_extension ) { // вынести расширение в параметры

			$file_content = include $file_path;

			$file_output_path = $output_dir . DIRSEP . $name . '.' . $output_file_extension; // вынести расширение в параметры

			$handle = fopen($file_output_path , 'w');
			fwrite($handle, $file_content);
			fclose($handle);

		 } else if ( is_file($file_path) ) {
			unlink($file_path);
		 } 
	}

	$files_source_array = clean_dots_scandir( $source_dir );// массив исходных файлов стилей(без точек)

	$files_source_array = str_replace($source_file_extension, $output_file_extension, $files_source_array);// массив исходных с заменой расширения php на css для сравнения с массивом сгенерированных файлов css

	$files_output_array = clean_dots_scandir( $output_dir );// массив сгерерированных файлов стилей

	$array_diff = array_diff($files_output_array, $files_source_array);// разница массивов

	foreach ($array_diff as $file_to_delete) {
		$file_to_delete_path = $output_dir . DIRSEP . $file_to_delete;
		unlink($file_to_delete_path);
	}

}

generate_output_files('templates/css/css-source/sections', 'templates/css/css-output/sections', FILEEXTENSION_PHP, FILEEXTENSION_CSS);
generate_output_files('templates/css/css-source/common', 'templates/css/css-output/common', FILEEXTENSION_PHP, FILEEXTENSION_CSS);

generate_output_files('templates/html/html-source/sections', 'templates/html/html-output/sections', FILEEXTENSION_PHP, FILEEXTENSION_HTML);
generate_output_files('templates/html/html-source/common', 'templates/html/html-output/common', FILEEXTENSION_PHP, FILEEXTENSION_HTML);


/**
 * С помощью include ыводит содержимое всех файлов из папки $dir_name
 * @param  string $dir_name путь к дирректории в формате 'templates/html/html-output/sections'
 */
function include_files($dir_name) {

	$files = clean_dots_scandir($dir_name);

	$id = 1;// $id строки таблицы sections

	foreach ($files as $file_name) {

		$global_arr = 'tmpl_' . $id;

		global ${$global_arr};

		$file_path = ROOT . DIRSEP . $dir_name . DIRSEP . $file_name;

		if ( file_exists($file_path) ) {
			// echo '<form name="block_edit_' . $id . '" method="post" action="handler.php" enctype="multipart/form-data">';
			include $file_path;// вывод скомпилированного .html
			?>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="form__wrapper admin">
							<?php
							// .section_name_form первоначально скрытая отдельная форма с полем для изменения
							// класса основного контейнера секции
							// include 'templates/html/modules-admin/section_name_form.php';
							?>
							<form name="block_edit_<?php echo $id; ?>" method="post" action="handler.php" enctype="multipart/form-data">
								<div class="inputs__wraper">
								<?php
								// вывод input[type="file"] в колличестве колонок Bootstrap данного блока
								if (isset(${$global_arr}['count_col']) && ${$global_arr}['if_col_has_img_to_download'] === true) {
									include 'templates/html/modules-admin/inputs_type_file.php';
								}

								// вывод input[type="text"] в колличестве всех подключенных полей в шаблоне кроме полей для ЗАГОЛОВКА
								// поля в шаблоне добавляются в глобальный массив '$tmpl_' . $id
								// если первый символ в $key это $, то выводим input[type="text"] и
								// если в начале ключа массива есть '$title', то пропускаем эти ключи(выводим их позже в отдельный блок для всего что касается Заголовка)
								foreach (${$global_arr} as $key => $value) {
									if (strpos($key, '$') === 0) {
										if (strpos($key, '$title') === 0) continue;
										echo '<input type="text" name="' . $value . '" placeholder="' . $value . '">';
									}
								}

								// вывод input[type="text"] в колличестве всех подключенных полей в шаблоне для ЗАГОЛОВКА
								// поля в шаблоне добавляются в глобальный массив '$tmpl_' . $id
								// если первый символ в $key это $, то выводим input[type="text"] и 
								// если в начале ключа массива есть '$title', то выводим input[type="text"] для этих ключей
								if (isset(${$global_arr}['$title'])) {
									echo '<div class=title-edit-wrap>';
									foreach (${$global_arr} as $key => $value) {
										if (strpos($key, '$title') === 0) {
											echo '<input type="text" name="' . $value . '" placeholder="' . $value . '">';
										}
									}

									// Положение заголовка блока
									include 'templates/html/modules-admin/title_text_center.php';

									// Заглавные/прописные буквы заголовка блока
									include 'templates/html/modules-admin/title_text_uppercase.php';

									

									echo '</div>';
								}

								// Выбрать блок ???????????????? не подключен но выведен в index.php
								echo '<div class="block_changed">
									  	  <label>Выбрать блок 
									  	  		<input type="checkbox" name="block_selected" value="selected" checked>
									  	   </label>
									   </div><!-- .block_changed -->';

								// Количество блоков
								if (isset(${$global_arr}['count_col'])) {
									include 'templates/html/modules-admin/bootstrap_col_qty.php';
								}

								// Кол-во колонок для разрешения
								if (isset(${$global_arr}['count_col'])) {
									include 'templates/html/modules-admin/bootstrap_classes.php';
								}

								// input[class="id_hidden_wrap"]
								include 'templates/html/modules-admin/hidden_wrap.php';
									 
								// input[type="submit"]
								include 'templates/html/modules-admin/submit_wrap.php';
								?>

				
								</div><!-- inputs__wraper -->
							</form>
						</div><!-- form__wrapper -->
					</div><!-- col-xs-12 -->
				</div><!-- row -->
			</div><!-- container -->

			<?php
			$id++;
		}
	}
	clearstatcache();
}


/**
 * Выводит форму для общих стилей
 * @param  Array $arr глобальный массив с переменными для полей формы(из файла common-css.php)
 */
function include_form($arr) {

	$id = $arr['id'];
	unset($arr['id']);
	?>
	<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="form__wrapper">
							<form name="block_edit_<?php echo $id; ?>" id-"<?php echo $id; ?>" method="post" action="handler.php">
								<div class="inputs__wraper">

								<?php
								foreach ($arr as $key => $value) {
									echo '<input type="text" name="' . $value . '" placeholder="' . $value . '">';
								}
								?>

									<input name="id" hidden="hidden" value="<?php echo $id; ?>">
									<input type="submit" value="Изменить" name="submit">
								</div><!-- inputs__wraper -->
							</form>
						</div><!-- form__wrapper -->
					</div><!-- col-xs-12 -->
				</div><!-- row -->
			</div><!-- container -->
<?php
}



function loop_get_string_bootstrap_item() {
	$args = func_get_args();


}
















