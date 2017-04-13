<?php
include 'header.php';

// myvardump($tmpl_1);


include_form($tmpl_common_css);

include_files('templates/html/html-output/sections');




// $file_name = 'partners_1.jpg';

// $file = pathinfo($file_name);

// $file_extension = $file['extension'];

// $file_basename = $file['basename'];

// $file_without_extension_less = basename($file_basename, '.' . $file_extension);

// $strripos = strripos($file_without_extension_less, '_');

// // если имя файла partners_1, то $shortname = "partners"
// $shortname = substr($file_without_extension_less, 0, $strripos);

// // если имя файла partners_1, то $number_of_name = "_1"
// $number_of_name = substr($file_without_extension_less, $strripos);




echo '<pre>';
var_dump($GLOBALS);
echo '</pre>';














include 'footer.php';