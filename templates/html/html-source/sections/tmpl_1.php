<?php
include_once ROOT . '/functions.php';

$db = new Database();

$tmpl_id = 1;

$title        = $db->get_val('title', $tmpl_id, 'Section title', 'html_content');
$section_name = $db->get_val('section_name', $tmpl_id, 'section_1', 'html_content');

// Количество блоков в сетке Bootstrap
$count_col = $db->get_val('count_col', $tmpl_id, 3, 'html_content');



// myvardump($tmpl_1);

// Переменные без добавления в глобальный массив
// Центрирование заголовка секции
$title_text_center = $db->get_val('title_text_center', $tmpl_id, 'text-center', 'html_content');// одно из трёх значений

// Заглавные или прописные буквы заголовка секции
$title_text_uppercase = $db->get_val('title_text_uppercase', $tmpl_id, 'text_capitalize', 'html_content');// одно из трёх значений

// Адаптивные классы Bootstrap при разных разрешениях монитора
$col_lg =     $db->get_val('col_lg',     $tmpl_id, 3, 'html_content');// одно из .. значений
$col_md =     $db->get_val('col_md',     $tmpl_id, 3, 'html_content');// одно из .. значений
$col_sm =     $db->get_val('col_sm',     $tmpl_id, 3, 'html_content');// одно из .. значений
$col_xs_768 = $db->get_val('col_xs_768', $tmpl_id, 3, 'html_content');// одно из .. значений
$col_xs_479 = $db->get_val('col_xs_479', $tmpl_id, 3, 'html_content');// одно из .. значений
$col_xs_380 = $db->get_val('col_xs_380', $tmpl_id, 3, 'html_content');// одно из .. значений


create_array($tmpl_id, 'title', 'section_name', array('count_col' => $count_col, 'col_lg' => $col_lg, 'sect_name' => $section_name));


// <div class="' . $section_name . '" id="' . $tmpl_id . '"> передаем id=......$tmpl_id для переадресации к тому же экрану с которого был отправлен запрос
$html = '<!-- ' . $section_name . ' -->
<div class="' . $section_name . '" id="' . $tmpl_id . '">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="' . $section_name . '__title ' . $title_text_center . ' ' . $title_text_uppercase . '">' . $title . '</h3>
            </div>
        </div>
    </div>

    <div class="container ' . $section_name . '__container">
        <div class="row ' . $section_name . '__row">';



for ($i=1; $i <= $count_col; $i++) { 
                
$html .=    '<div class="col-lg-' . $col_lg . ' col-md-' . $col_md . ' col-sm-' . $col_sm . ' col-xs-' . $col_xs_768 . ' col-479-' . $col_xs_479 . ' col-380-' . $col_xs_380 . ' ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_' . $i . '.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>';

}



            
$html .= '</div>
    </div>
</div>
<!-- ' . $section_name . ' End -->';

return $html;