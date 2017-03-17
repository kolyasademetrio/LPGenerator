<?php


$styles = '/* ------------------------>>> services <<<----------------------------------------------------- */
.services {
	padding: 55px 0 0;
	background: #fff url(../img/services/bg/bg_services.jpg) center 0 no-repeat;
	background-size: cover;
}

.services__title {
	font-family: "RobotoLight";
	font-style: normal;
	font-weight: normal;
	font-size: 23px;
	color: #565a65;
	text-transform: uppercase;

	margin: 0 0 55px;
}

.services__container {
	max-width: 1012px;
}

.services__container,
.services__innerItem {
	padding-left: 6px;
	padding-right: 6px;
}

.services__row {
	margin-left: 6px;
	margin-right: 6px;
}

.services__innerItem {
	margin-bottom: 40px;
}

.services__item {
	border: 3px solid transparent;
	-webkit-transition: all .6s ease 0s;
	-moz-transition: all .6s ease 0s;
	-o-transition: all .6s ease 0s;
	transition: all .6s ease 0s;
}

.services__header {
	margin-bottom: 25px;
}

.services__img {
	width: 100%;
	height: auto;
}

.services__footer {
	font-family: "RobotoRegular";
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	color: #fff;
}

.services__innerItem:nth-child(1) .services__footer,
.services__innerItem:nth-child(2) .services__footer {
	color: #313131;
}

.services__subtitle {
	font-family: "RobotoRegular";
	font-style: normal;
	font-weight: normal;
	font-size: 18px;
	color: #fff;

	margin: 0 0 40px;
}

.services__orderBtn {
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

.services__orderBtn:hover {
	text-decoration: underline;
	color: #fff;
}

.services__orderBtn:focus {
	color: #fff;
}

@media ( min-width: 992px ) {

	.services__innerItem:nth-child(4n+1) {
		clear: both;
	}

}

@media ( max-width: 992px ) and ( min-width: 768px ) {

	.services__innerItem:nth-child(4n+1) {
		clear: both;
	}

}

@media ( max-width: 767px ) and ( min-width: 479px ) {

	.services__innerItem:nth-child(2n+1) {
		clear: both;
	}

}

@media ( max-width: 992px ) {

	.services__footer {
		color: #313131 !important;
	}

}

@media ( max-width: 768px ) {

	.services {
		padding-top: 30px;
	}

	.services__title {
		font-size: 20px;

		margin: 0 0 30px;
	}

}

/* ------------------------>>> services End <<<------------------------------------------------- */';

return $styles;

?>