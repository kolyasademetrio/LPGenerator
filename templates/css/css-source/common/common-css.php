<?php

include_once ROOT . '/functions.php';

$db = new Database();

$tmpl_id = 'common_css';

$container_max_width = $db->get_val('container_max_width', $tmpl_id, 1030, 'css_common');

create_array($tmpl_id, array(
								'container_max_width'
							));


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
/* прижать футер к низу End */

.text-center {
	text-align: center;
}

.text-left {
	text-align: left;
}

.text-right {
	text-align: right;
}

.text-uppercase {
	text-transform: uppercase;
}

.text-lowercase {
	text-transform: lowercase;
}

.text-capitalize:first-letter {
	text-transform: uppercase;
}

@media (max-width: 479px) {
	.col-479-12 {
		width: 100%;
		float: none;
		text-align: center;
	}

	.col-479-6 {
		width: 50%;
	}

	.col-479-4 {
		width: 33.33333333%;
	}

	.col-479-3 {
		width: 25%;
	}

	.col-479-20per {
		width: 20%;
	}

	.col-479-2 {
		width: 16.66666667%;
	}

	.col-479-1 {
		width: 8.33333333%;
	}
}

@media (max-width: 380px) {
	.col-380-12 {
		width: 100%;
		float: none;
		text-align: center;
	}

	.col-380-6 {
		width: 50%;
	}

	.col-380-4 {
		width: 33.33333333%;
	}

	.col-380-3 {
		width: 25%;
	}

	.col-380-20per {
		width: 20%;
	}

	.col-380-2 {
		width: 16.66666667%;
	}

	.col-380-1 {
		width: 8.33333333%;
	}
}

.container {
	max-width: ' . $container_max_width . 'px;
}';

return $styles;

?>