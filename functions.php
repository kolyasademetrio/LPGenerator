<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('FILEEXTENSION_PHP', 'php');
define('FILEEXTENSION_CSS', 'css');
define('FILEEXTENSION_HTML', 'html');


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

		$file_path = $dir_name . '/' . $file_name;

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
 * @param string передаются параметры, где первый - $id, остальные - добавляются в глобальный массив
 */
function create_array() {

	$args = func_get_args();

	$id = $args[0];

	$arrayName = 'tmpl_' . $id;

	global ${$arrayName};

	for ($i = 0; $i < count($args); $i++) {
		if ( !is_array($args[$i]) ) {

			if ($i > 0) {

				${$arrayName}['$' . $args[$i]] = $args[$i];

			} else {

				${$arrayName}['id'] = $args[$i];

			}

		} else {

			foreach ($args[$i] as $key => $value) {

				${$arrayName}[$key] = $value;

			}

		}
	}
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

		$file_path = ROOT . '/' . $source_dir . '/' . $file_name;

		if ( is_dir($file_path) ) {
			array_map('unlink', glob("$file_path/*.*"));
			rmdir($file_path);
			continue;
		}

		$file_extension = get_extension($file_path);

		$name = substr($file_name, 0, strpos($file_name, '.' . $file_extension));

		if ( is_file($file_path) && $file_extension === $source_file_extension ) { // вынести расширение в параметры

			$file_content = include $file_path;

			$file_output_path = $output_dir . '/' . $name . '.' . $output_file_extension; // вынести расширение в параметры

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
		$file_to_delete_path = $output_dir . '/' . $file_to_delete;
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

	$select_options = array(
		'col_lg'     => 'больше 1200',
		'col_md'     => 'больше 992',
		'col_sm'     => 'больше 768',
		'col_xs_768' => 'меньше 768',
		'col_xs_479' => 'меньше 479',
		'col_xs_380' => 'меньше 360',
	);



	foreach ($files as $file_name) {

		$global_arr = 'tmpl_' . $id;

		global ${$global_arr};

		$file_path = ROOT . '/' . $dir_name . '/' . $file_name;

		if ( file_exists($file_path) ) {

			include $file_path;// вывод скомпилированного .html
			?>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="form__wrapper">
							<form name="block_edit_<?php echo $id; ?>" method="post" action="handler.php" enctype="multipart/form-data">
								<div class="inputs__wraper">

								<?php

									// var_dump(${$global_arr});

									// вывод input[type="file"] в колличестве колонок Bootstrap данного блока
									echo '<div class="inputs_image_download_wrap row">';
										  for ($i = 0; $i < ${$global_arr}['count_col']; $i++) {
										  	 echo '<div class="col-xs-' . ${$global_arr}['col_lg'] . '">
										  	 			<input type="file" name="col_image">
									  	 		   </div>';
										  }
									echo '</div>';

									// вывод input[type="text"] в колличестве всех подключенных полей в шаблоне
									// поля в шаблоне добавляются в глобальный массив '$tmpl_' . $id
									// из перебора исключаются ключи id и count_col
									foreach (${$global_arr} as $key => $value) {

										if ($key == 'id' || $key == 'count_col' || $key == 'col_md') continue;

										echo '<input type="text" name="' . $value . '" placeholder="' . $value . '">';
									}

									// Положение заголовка блока
									echo '<div class="title_text_center">
											  <label>Положение заголовка блока
													<select name="title_text_center">
														<option value="">Выбрать</option>
														<option value="text-center">По центру</option>
														<option value="text-left">Слева</option>
														<option value="text-right">Справа</option>
													</select>
											   </label>
										 </div>';


									// Заглавные/прописные буквы заголовка блока
									echo '<div class="title_text_uppercase">
											  <label>Заглавные/прописные буквы заголовка блока
											  		<select name="title_text_uppercase">
											  			<option value="">Выбрать</option>
											  			<option value="text-uppercase">Все большие</option>
											  			<option value="text-capitalize">Первая большая</option>
											  			<option value="text-lowercase">Все маленькие</option>
										  			</select>
											  </label>
										  </div><!-- .title_text_uppercase -->';


									// Выбрать блок ???????????????? не подключен но выведен в index.php
									echo '<div class="block_changed">
										  	  <label>Выбрать блок 
										  	  		<input type="checkbox" name="block_selected" value="selected" checked>
										  	   </label>
										   </div><!-- .block_changed -->';

									// Количество блоков
									echo '<div class="bootstrap_col_qty">
												<label>Количество блоков: 
													<input type="number" name="count_col" min="1" max="20" value="">		
												</label>
										  </div><!-- .bootstrap_col_qty -->';

									// Кол-во колонок для разрешения
									echo '<div class="bootstrap_classes">';
										foreach ($select_options as $attr_name => $lable_text) {
											echo '<div class="bootstrap_classes_item">
												  	<label>Кол-во колонок для разрешения ' . $lable_text . 'px:
												       <select name="' . $attr_name . '">';

											echo       	   '<option value="">Выбрать</option>
															<option value="12">Одна</option>
															<option value="6">Две</option>
															<option value="4">Три</option>
															<option value="3">Четыре</option>
															<option value="20per">Пять</option>
															<option value="2">Шесть</option>
															<option value="1">Двенадцать</option>';	       
															
											echo	   '</select>
												  	</label>
												  </div><!-- .bootstrap_classes_item -->';
										}	
									echo '</div><!-- bootstrap_classes -->';

									echo  '</div>';

									// input[class="id_hidden_wrap"]
									echo '<div class="id_hidden_wrap">
												<input name="id" hidden="hidden" value="' . ${$global_arr}['id'] . '">
										  </div><!-- .id_hidden_wrap -->';
										 
									// input[type="submit"]
									echo '<div class="submit_wrap">
										 		<input type="submit" value="Изменить блок" name="submit">
										 </div><!-- .submit_wrap -->';
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
















