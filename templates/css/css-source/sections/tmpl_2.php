<?php

include_once ROOT . '/functions.php';

$db = new Database();

$tmpl_id = 2;

$section_name = $db->get_val('section_name', $tmpl_id, 'section', 'html_content');

$section_padding_top = $db->get_val('section_padding_top', $tmpl_id, 47, 'css_content');
$section_padding_bottom = $db->get_val('section_padding_bottom', $tmpl_id, 47, 'css_content');
$border_width = $db->get_val('border_width', $tmpl_id, 10, 'css_content');

/**
 * Создаёт глобальный массив со всеми переданными переменными
 * @param первый - id-шаблона
 * @param второй - массив для вывода в админку input[type="text"]
 * @param третий - массив для вывода в глобальную область видимости
 */
create_array($tmpl_id, array(
								'section_name',
								'section_padding_top',
								'section_padding_bottom',
								'border_width'
							),
						array(
								// 'var_test' => 'var_test_value'
							));


$styles = '/* ------------------------>>> ' . $section_name . ' <<<----------------------------------------------------- */
.' . $section_name . ' {
	padding: ' . $section_padding_top . 'px 0 ' . $section_padding_bottom . 'px;
	background: #fff url(../img/' . $section_name . '/bg/bg_' . $section_name . '.jpg) center 0 no-repeat;
	background-size: cover;
	border-bottom: ' . $border_width . 'px solid #369;
}

.' . $section_name . '__title {
	font-family: "RobotoLight";
	font-style: normal;
	font-weight: normal;
	font-size: 23px;
	color: #565a65;

	margin: 0 0 55px;
}

.' . $section_name . '__container {
	max-width: 1012px;
}

.' . $section_name . '__container,
.' . $section_name . '__innerItem {
	padding-left: 6px;
	padding-right: 6px;
}

.' . $section_name . '__row {
	margin-left: 6px;
	margin-right: 6px;
}

.' . $section_name . '__innerItem {
	margin-bottom: 40px;
}

.' . $section_name . '__item {
	border: 3px solid transparent;
	-webkit-transition: all .6s ease 0s;
	-moz-transition: all .6s ease 0s;
	-o-transition: all .6s ease 0s;
	transition: all .6s ease 0s;
}

.' . $section_name . '__header {
	margin-bottom: 25px;
}

.' . $section_name . '__img {
	width: 100%;
	height: auto;
}

.' . $section_name . '__footer {
	font-family: "RobotoRegular";
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	color: #fff;
}

.' . $section_name . '__innerItem:nth-child(1) .' . $section_name . '__footer,
.' . $section_name . '__innerItem:nth-child(2) .' . $section_name . '__footer {
	color: #313131;
}

.' . $section_name . '__subtitle {
	font-family: "RobotoRegular";
	font-style: normal;
	font-weight: normal;
	font-size: 18px;
	color: #fff;

	margin: 0 0 40px;
}

.' . $section_name . '__orderBtn {
	display: inline-block;
	height: 50px;
	width: 210px;
	line-height: 50px;
	background-color: #f77232;
	color: #fff;
	text-transform: uppercase;
	font-family: "RobotoRegular";
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	display: inline-block;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	-o-border-radius: 2px;
	border-radius: 2px;
}

.' . $section_name . '__orderBtn:hover {
	text-decoration: underline;
	color: #fff;
}

.' . $section_name . '__orderBtn:focus {
	color: #fff;
}

@media ( min-width: 992px ) {

	.' . $section_name . '__innerItem:nth-child(4n+1) {
		clear: both;
	}

}

@media ( max-width: 992px ) and ( min-width: 768px ) {

	.' . $section_name . '__innerItem:nth-child(4n+1) {
		clear: both;
	}

}

@media ( max-width: 767px ) and ( min-width: 479px ) {

	.' . $section_name . '__innerItem:nth-child(2n+1) {
		clear: both;
	}

}

@media ( max-width: 992px ) {

	.' . $section_name . '__footer {
		color: #313131 !important;
	}

}

@media ( max-width: 768px ) {

	.' . $section_name . ' {
		padding-top: 30px;
	}

	.' . $section_name . '__title {
		font-size: 20px;

		margin: 0 0 30px;
	}

}

/* ------------------------>>> ' . $section_name . ' End <<<------------------------------------------------- */';

return $styles;

?>