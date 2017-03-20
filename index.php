<?php
include 'header.php';


includeFile('templates/html/html-output');

$db = new Database();

$db->getVal('section_padding', 1, 10);


?>

<pre>

</pre>

<?
include 'footer.php'; ?>