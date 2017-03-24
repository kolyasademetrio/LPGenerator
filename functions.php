<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('FILEEXTENSION_PHP', 'php');
define('FILEEXTENSION_CSS', 'css');
define('FILEEXTENSION_HTML', 'html');

function __autoload( $className ) {
	$className = str_replace('..', '', $className);
	require_once "model/$className.php";
}


// array_column — Возвращает массив из значений одного столбца входного массива
// добавляем свою функцию array_column так как испоьзую PHP 5.4 и в этой версии нет этой функции
// использую для подсчёта и вывода всех имен таблиц в базе данных
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



/*
* Выводит теги <link rel="stylesheet" href=""></link>
* с ссылкой на все файлы из директории $dirName
*/
function loadStylesheets( $dirName ) {

	$files = scandir( $dirName );

	$files = array_diff($files, array('.', '..'));

	foreach ($files as $fileName) {

		$filePath = $dirName . '/' . $fileName;

		if ( file_exists($filePath) ) {
			echo '<link rel="stylesheet" href="' . $filePath . '">';
		}
		
	}

}


/*
* Возвращает расширение файла
*/
function getExtension( $filePathName ) {
    $path_info = pathinfo($filePathName);
    return $path_info['extension'];
}


/*
* Получает массив всех файлов в директории.
* Удаляет из массива точки
*/
function cleanDots_scandir ($dirPath) {
	$arrFiles = scandir( $dirPath );
	$cleanArrFiles = array_diff($arrFiles, array('.', '..'));

	return $cleanArrFiles;
}




/*
* Открывает исходные файлы в папке $sourceDir берёт то что они возвращают
* и создаёт файлы css с такими же именами.
* Если файл есть - перезаписывает содержимое.
* Если файла нет - создает и записывает содержимое.
*/
function generateOutputFiles($sourceDir, $outputDir, $sourceFileExtension, $outputFileExtension) {

	$filesSourceArray = cleanDots_scandir( $sourceDir );
	$filesOutputArray = cleanDots_scandir( $outputDir );

	foreach($filesSourceArray as $fileName) {

		$filePath = ROOT . '/' . $sourceDir . '/' . $fileName;

		if ( is_dir($filePath) ) {
			array_map('unlink', glob("$filePath/*.*"));
			rmdir($filePath);
			continue;
		}

		$fileExtension = getExtension($filePath);

		$name = substr($fileName, 0, strpos($fileName, '.' . $fileExtension));

		if ( is_file($filePath) && $fileExtension === $sourceFileExtension ) { // вынести расширение в параметры

			$fileСontent = include $filePath;

			$fileOutputPath = $outputDir . '/' . $name . '.' . $outputFileExtension; // вынести расширение в параметры

			$handle = fopen($fileOutputPath , 'w');
			fwrite($handle, $fileСontent);
			fclose($handle);

		 } else if ( is_file($filePath) ) {
			unlink($filePath);
		 } //else if ( is_dir($filePath) ) {
		// 	array_map('unlink', glob("$filePath/*.*"));
		// 	rmdir($filePath);
		// }

	}

	$filesSourceArray = cleanDots_scandir( $sourceDir );// массив исходных файлов стилей(без точек)

	$filesSourceArray = str_replace($sourceFileExtension, $outputFileExtension, $filesSourceArray);// массив исходных с заменой расширения php на css для сравнения с массивом сгенерированных файлов css

	$filesOutputArray = cleanDots_scandir( $outputDir );// массив сгерерированных файлов стилей

	$array_diff = array_diff($filesOutputArray, $filesSourceArray);// разница массивов

	foreach ($array_diff as $fileToDelete) {
		$fileToDeletePath = $outputDir . '/' . $fileToDelete;
		unlink($fileToDeletePath);
	}

}

generateOutputFiles('templates/css/css-source/sections', 'templates/css/css-output/sections', FILEEXTENSION_PHP, FILEEXTENSION_CSS);
generateOutputFiles('templates/css/css-source/common', 'templates/css/css-output/common', FILEEXTENSION_PHP, FILEEXTENSION_CSS);

generateOutputFiles('templates/html/html-source/sections', 'templates/html/html-output/sections', FILEEXTENSION_PHP, FILEEXTENSION_HTML);
generateOutputFiles('templates/html/html-source/common', 'templates/html/html-output/common', FILEEXTENSION_PHP, FILEEXTENSION_HTML);


/*
* Выводит содержимое всех файлов из папки $dirName
*
*/
function includeFile( $dirName ) {


	$files = cleanDots_scandir($dirName);

	$id = 1;// $id строки таблицы sections

	foreach ($files as $fileName) {

		$globalArr = 'tmpl_' . $id;

		global ${$globalArr};

		$filePath = ROOT . '/' . $dirName . '/' . $fileName;

		if ( file_exists($filePath) ) {

			echo '<form name="block_edit_' . $id . '" method="post" action="handler.php">';
				include $filePath;// вывод скомпилированного .html

				echo '<div class="input__wraper">';
				$i = 0;
				foreach (${$globalArr} as $key => $value) {

					if ($i > 0) {
						echo '<input type="text" name="' . $value . '" placeholder="' . $value . '">';
					}

					$i++;
					
				}

			echo '<input name="id" hidden="hidden" value="' . ${$globalArr}['id'] . '"><input type="submit" value="Изменить блок" name="submit">';
			echo '</div></form>';

			$id++;
			
		}
		
	}
	clearstatcache();
}




function createArray() {

	$args = func_get_args();

	$id = $args[0];

	$arrayName = 'tmpl_' . $id;

	global ${$arrayName};

	$i = 0;

	foreach ($args as $value) {
		if ($i > 0) {
			${$arrayName}['$' . $value] = $value;
		} else {
			${$arrayName}['id'] = $value;
		}

		$i++;
	}
	
}









