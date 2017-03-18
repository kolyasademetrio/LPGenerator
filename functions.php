<?php

define('FILEEXTENSION_PHP', 'php');
define('FILEEXTENSION_CSS', 'css');


/*
* Выводит содержимое всех файлов из папки $dirName
*
*/
function includeFile( $dirName ) {

	$files = scandir( $dirName );

	$files = array_diff($files, array('.', '..'));

	foreach ($files as $fileName) {

		$filePath = $dirName . '/' . $fileName;

		if ( file_exists($filePath) ) {
			include $filePath;
		}
		
	}

	clearstatcache();

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
* Открывает файлы php в папке 'templates/css/css-php' берёт то что они возвращают
* и создаёт файлы css с такими же именами.
* Если файл есть - перезаписывает содержимое.
* Если файла нет - создает и записывает содержимое.
*/
function generateStylesheets($outputDir, $inputDir) {

	$dirCSSphpPath = $outputDir;
	$dirCSSadminPath = $inputDir;

	$filesCSSphpArray = cleanDots_scandir( $dirCSSphpPath );
	$filesCSSadminArray = cleanDots_scandir( $dirCSSadminPath );

	foreach($filesCSSphpArray as $filesCSSphpName) {

		$fileCSSphpPath = $dirCSSphpPath . '/' . $filesCSSphpName;

		$fileExtension = getExtension($fileCSSphpPath);

		$name = substr($filesCSSphpName, 0, strpos($filesCSSphpName, '.' . $fileExtension));

		if ( is_file($fileCSSphpPath) && $fileExtension === FILEEXTENSION_PHP ) {

			$fileCSScontent = include $fileCSSphpPath;

			$fileCSSadminPath = $dirCSSadminPath . '/' . $name . '.' . FILEEXTENSION_CSS;

			$handle = fopen($fileCSSadminPath , 'w');
			fwrite($handle, $fileCSScontent);
			fclose($handle);

		} else if ( is_file($fileCSSphpPath) ) {
			unlink($fileCSSphpPath);
		} else if ( is_dir($fileCSSphpPath) ) {
			array_map('unlink', glob("$fileCSSphpPath/*.*"));
			rmdir($fileCSSphpPath);
		}

	}

	$filesCSSphpArray = cleanDots_scandir( $dirCSSphpPath );
	$filesCSSadminArray = cleanDots_scandir( $dirCSSadminPath );

	// $array_diff = array_diff($filesCSSadminArray, $filesCSSphpArray);

	echo '<pre><p>Сгенерированные CSS-файлы</p>';
	$filesCSSadminArray = cleanDots_scandir( $dirCSSadminPath );
	var_dump($filesCSSadminArray);
	echo '</pre>';

	echo '<pre><p>Исходные CSS-файлы .php</p>';
	$filesCSSphpArray = cleanDots_scandir( $dirCSSphpPath );
	var_dump($filesCSSphpArray);
	echo '</pre>';

}

generateStylesheets('templates/css/css-php', 'templates/css/css-admin');


?>
