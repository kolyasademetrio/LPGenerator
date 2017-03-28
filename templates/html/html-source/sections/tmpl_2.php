<?php

include_once ROOT . '/functions.php';

$db = new Database();

$tmpl_id = 2;

$title        = $db->get_val('title', $tmpl_id, 'Section title', 'html_content');
$section_name = $db->get_val('section_name', $tmpl_id, 'section_1', 'html_content');

create_array($tmpl_id, 'title', 'section_name', 'border_width');

// переменные без добавления в глобальный массив
$title_text_center = $db->get_val('title_text_center', $tmpl_id, 'text-center', 'html_content');// одно из трёх значений
$title_text_uppercase = $db->get_val('title_text_uppercase', $tmpl_id, 'text_capitalize', 'html_content');// одно из трёх значений




$html = '<!-- ' . $section_name . ' -->
<div class="' . $section_name . '">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="' . $section_name . '__title ' . $title_text_center . ' ' . $title_text_uppercase . '">' . $title . '</div>
            </div>
        </div>
    </div>

    <div class="container ' . $section_name . '__container">
        <div class="row ' . $section_name . '__row">
            <div class="col-md-3 col-sm-3 col-xs-6 col-xs-100 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item">
                    <div class="' . $section_name . '__header text-center">
                        <img src="img/' . $section_name . '/photos/' . $section_name . '_1.jpg" alt="" class="' . $section_name . '__img">
                    </div>
                    <div class="' . $section_name . '__footer text-center">Помощь в подборе<br> спортивного оборудования</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 col-xs-100 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item">
                    <div class="' . $section_name . '__header text-center">
                        <img src="img/' . $section_name . '/photos/' . $section_name . '_2.jpg" alt="" class="' . $section_name . '__img">
                    </div>
                    <div class="' . $section_name . '__footer text-center">Ввоз заграничных<br> тренажеров по лучшим ценам</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 col-xs-100 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item">
                    <div class="' . $section_name . '__header text-center">
                        <img src="img/' . $section_name . '/photos/' . $section_name . '_3.jpg" alt="" class="' . $section_name . '__img">
                    </div>
                    <div class="' . $section_name . '__footer text-center">Открытие тренажерного<br> зала "под ключ"</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 col-xs-100 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item">
                    <div class="' . $section_name . '__header text-center">
                        <img src="img/' . $section_name . '/photos/' . $section_name . '_4.jpg" alt="" class="' . $section_name . '__img">
                    </div>
                    <div class="' . $section_name . '__footer text-center">Ремонт и обслуживание<br> тренажеров</div>
                </div>
            </div>
        </div>
    </div><!-- ' . $section_name . '__container -->
</div>
<!-- ' . $section_name . ' End -->';

return $html;