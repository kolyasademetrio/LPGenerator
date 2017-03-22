<?php

include_once ROOT . '/functions.php';

$db = new Database();

$tmpl_id = 0;

$container_max_width = $db->getVal('container_max_width', $tmpl_id, 1030, 'css_content_common');

createArray($tmpl_id, 'container_max_width');


$styles = '/*common styles*/
ul, li {
	margin: 0;
	padding: 0;
	list-style: none;
}

h1, h2, h3, h4, h5, h6, p {
	margin: 0;
}

/*@media templates*/
@media (max-width: 1200px) {

}

@media (max-width: 992px) {

}

@media (max-width: 768px) {

}

@media (max-width: 479px) {

}

/*main styles*/

/* прижать футер к низу */
html,
body {
	height: 100%;
}

.wrapper__main {
	display: table;
	height: 100%;
	width: 100%;
}

.content__main {
	display: table-row;
	height: 100%;
}

.text-center {
	text-align: center;
}

@media (max-width: 479px) {
	.col-xs-100 {
		width: 100%;
		float: none;
		text-align: center;
	}

	.col-xs-50 {
		width: 50%;
	}
}

@media (max-width: 380px) {
	.col-xs-100-380 {
		width: 100%;
		float: none;
		text-align: center;
	}
}

.container {
	max-width: ' . $container_max_width . 'px;
}';

return $styles;

?>