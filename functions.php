<?php

define('FILEEXTENSION_PHP', 'php');
define('FILEEXTENSION_CSS', 'css');

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

function after ($after, $string){
       
    if (!is_bool(strpos($string, $after)))
    return substr($string, strpos($string,$after)+strlen($after));

}

function getExtension( $filename ) {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

function cleanDots_scandir ($dirPath) {
	$arrFiles = scandir( $dirPath );
	$cleanArrFiles = array_diff($arrFiles, array('.', '..'));

	return $cleanArrFiles;
}

function generateStylesheets(  ) {

	$dirCSSphpPath = 'templates/css/css-php';

	$dirCSSadminPath = 'templates/css/css-admin';

	$filesCSSphpArray = cleanDots_scandir( $dirCSSphpPath );

	

	foreach($filesCSSphpArray as $filesCSSphpName) {

		$fileCSSphpPath = $dirCSSphpPath . '/' . $filesCSSphpName;

		$fileExtension = getExtension($fileCSSphpPath);

		$name = substr($filesCSSphpName, 0, strpos($filesCSSphpName, '.' . $fileExtension));

		if ( file_exists($fileCSSphpPath) && $fileExtension === FILEEXTENSION_PHP ) {//end($fileExtensionArr) === 'php'
			$fileCSScontent = include $fileCSSphpPath;

			$fileCSSadminPath = $dirCSSadminPath . '/' . $name . '.' . FILEEXTENSION_CSS;

			// $dirCSSadminPath

			$handle = fopen($fileCSSadminPath , 'w');
			fwrite($handle, $fileCSScontent);
			fclose($handle);

			// echo '<p style="padding:15px;border: 2px solid #30bced;margin:15px 15px;">' . $fileCSScontent . '</p>';

		} else {
			echo '<h1 style="padding:15px;border: 2px solid #30bced;margin:15px 15px;">Выводим расширения файтов которые не являются файлами PHP: ' . $fileExtension . '</h1>';
		}
	}

}




?>
