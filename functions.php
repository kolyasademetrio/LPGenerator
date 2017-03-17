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

	foreach($filesCSSphpArray as $filesCSSphpName) {

		$fileCSSphpPath = $dirCSSphpPath . '/' . $filesCSSphpName;

		$fileExtension = getExtension($fileCSSphpPath);

		$name = substr($filesCSSphpName, 0, strpos($filesCSSphpName, '.' . $fileExtension));

		if ( file_exists($fileCSSphpPath) && $fileExtension === FILEEXTENSION_PHP ) {//end($fileExtensionArr) === 'php'
			$fileCSScontent = include $fileCSSphpPath;

			$fileCSSadminPath = $dirCSSadminPath . '/' . $name . '.' . FILEEXTENSION_CSS;

			$handle = fopen($fileCSSadminPath , 'w');
			fwrite($handle, $fileCSScontent);
			fclose($handle);

		}
	}

}

generateStylesheets('templates/css/css-php', 'templates/css/css-admin');


?>
