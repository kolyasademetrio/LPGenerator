<?php


$styles = '/* ------------------------>>> partners <<<----------------------------------------------------- */
.partners {
	padding: 55px 0 54px;
	background-color: #fff;
}

.partners__title {
	font-family: "RobotoLight";
	font-style: normal;
	font-weight: normal;
	font-size: 23px;
	color: #565a65;
	text-transform: uppercase;

	margin: 0 0 55px;
}

.partners__container {
	max-width: 1006px;
}

.partners__container,
.partners__innerItem {
	padding-left: 3px;
	padding-right: 3px;
}

.partners__row {
	margin-left: -3px;
	margin-right: -3px;
}

.partners__innerItem {
	margin-bottom: 6px;
}

.partners__item {
	background-color: #e0e0e0;
	height: 56px;
	line-height: 56px;
}

.partners__img {
	display: inline-block;
	vertical-align: middle;
}

@media ( max-width: 768px ) {

	.partners__container {
		padding-left: 15px;
		padding-right: 15px;
	}

	.partners {
		padding: 30px 0 30px;
	}

	.partners__title {
		margin-bottom: 30px;
		font-size: 20px;
	}

}


/* ------------------------>>> partners End <<<------------------------------------------------- */';

return $styles;


?>