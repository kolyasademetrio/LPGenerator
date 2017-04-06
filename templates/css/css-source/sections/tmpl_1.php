<?php
include_once ROOT . '/functions.php';

$db = new Database();
//id шаблона, он же id строки в таблице из базы данных
$tmpl_id = 1;

/* получаем из базы данных все необходимые переменные
*
* @param имя перемнной в базе данных          string $valName
* @param id сеции 					             int $id (здесь id=1)
* @param значение переменной по умолчанию string|int $default
* @param название таблицы базы данных         string $tableName
*
* @return значение переменной из базы данных  string $varValue
*/
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

// echo $section_padding

$styles = '/* ------------------------>>> ' . $section_name . ' <<<----------------------------------------------------- */
.' . $section_name . ' {
	padding: '.$section_padding_top.'px 0 '.$section_padding_bottom.'px;
	background-color: #fff;
	border-bottom:' . $border_width . 'px solid #30bced;
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