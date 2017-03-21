<?php
include 'header.php';

// echo '<pre>';
// var_dump($tmpl_1);
// echo '</pre>';

includeFile('templates/html/html-output');

$db = new Database();

$db->getVal('section_padding', 1, 10);


// echo '<pre>';
// var_dump($tmpl_1);
// echo '</pre>';
?>

<pre>

</pre>

<?
include 'footer.php'; ?>