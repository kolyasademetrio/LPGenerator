<?php

if (isset($_GET['blockTitle'])) {
    $blockTitle = $_GET['blockTitle'];
} else {
    $blockTitle = 'С нами сотрудничают';
}

echo $_GET['blockTitle'];

$html = '<!-- partners -->
<div class="partners">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="partners__title text-center">' . $blockTitle . '</h3>
            </div>
        </div>
    </div>

    <div class="container partners__container">
        <div class="row partners__row">
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_1.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_2.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_3.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_4.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_5.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_6.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_7.jpg" alt="" class="partners__img">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 col-xs-50 col-xs-100-380 partners__innerItem">
                <div class="partners__item text-center">
                    <img src="img/partners/photos/partners_8.jpg" alt="" class="partners__img">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- partners End -->';

return $html;