<?php
$db = new Database();

$section_padding = $db->getVal('section_padding', 1, 47);
$section_name = $db->getVal('section_name', 1, 'section_name');

// echo $section_padding

$styles = '/* ------------------------>>> ' . $section_name . ' <<<----------------------------------------------------- */
.' . $section_name . ' {
	padding: '.$section_padding.'px 0 '.$section_padding.'px;
	background-color: #fff;
}

.' . $section_name . '__title {
	font-family: "RobotoLight";
	font-style: normal;
	font-weight: normal;
	font-size: 23px;
	color: #565a65;
	text-transform: uppercase;

	margin: 0 0 55px;
}

.' . $section_name . '__container {
	max-width: 1006px;
}

.' . $section_name . '__container,
.' . $section_name . '__innerItem {
	padding-left: 3px;
	padding-right: 3px;
}

.' . $section_name . '__row {
	margin-left: -3px;
	margin-right: -3px;
}

.' . $section_name . '__innerItem {
	margin-bottom: 6px;
}

.' . $section_name . '__item {
	background-color: #e0e0e0;
	height: 56px;
	line-height: 56px;
}

.' . $section_name . '__img {
	display: inline-block;
	vertical-align: middle;
}

@media ( max-width: 768px ) {

	.' . $section_name . '__container {
		padding-left: 15px;
		padding-right: 15px;
	}

	.' . $section_name . ' {
		padding: 30px 0 30px;
	}

	.' . $section_name . '__title {
		margin-bottom: 30px;
		font-size: 20px;
	}

}


/* ------------------------>>> ' . $section_name . ' End <<<------------------------------------------------- */';

return $styles;


?>