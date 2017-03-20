<?php
$db = new Database();

$title = $db->getVal('title', 1, 'Section title');
$section_name = $db->getVal('section_name', 1, 'section_1');

$html = '<!-- ' . $section_name . ' -->
<div class="' . $section_name . '">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="' . $section_name . '__title text-center">' . $title . '</h3>
            </div>
        </div>
    </div>

    <div class="container ' . $section_name . '__container">
        <div class="row ' . $section_name . '__row">
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_1.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_2.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_3.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_4.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_5.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_6.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_7.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 ' . $section_name . '__innerItem">
                <div class="' . $section_name . '__item text-center">
                    <img src="img/' . $section_name . '/photos/' . $section_name . '_8.jpg" alt="" class="' . $section_name . '__img">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ' . $section_name . ' End -->';

return $html;