<?php
include 'header.php';

 

include_form_blocks_selected('templates/html/html-output/sections');

include_form($tmpl_common_css);

echo '<div class="main_wrapper">';
include_files('templates/html/html-output/sections');
echo '</div><!-- .main_wrapper -->';




// myvardump($tmpl_1);




echo '<pre>';
var_dump($GLOBALS);
echo '</pre>';














include 'footer.php';