<?php
include 'header.php';

// myvardump($tmpl_common_css);





// сессию открыл в header.php
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
include_form($tmpl_common_css);

include_files('templates/html/html-output/sections');


















include 'footer.php';