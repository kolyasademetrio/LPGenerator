<?php
session_start();
include_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LPGenerator</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- flexslider -->
    <link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css" type="text/css"/>
    <!-- magnific-popup -->
    <link rel="stylesheet" href="assets/plugins/magnific-popup/magnific-popup.css">
    <!-- dropzone css -->
    <!-- <link rel="stylesheet" href="assets/plugins/dropzone/dropzone.css"> -->
    <!-- fonts css -->
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/admin.css">


    <!-- custom css -->
    <!-- выводим ссылки на таблицы стилей с помощью тегов <link> -->
    <?php load_stylesheets('templates/css/css-output/common'); ?>
    <?php load_stylesheets('templates/css/css-output/sections'); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
