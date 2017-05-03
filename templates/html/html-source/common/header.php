<?php
include_once ROOT . '/functions.php';

$db = new Database();

$tmpl_id = 'header';

$head_title = $db->get_val('head_title', $tmpl_id, 'Section title', 'html_common');// Заголовок секции

/**
 * Создаёт глобальный массив со всеми переданными переменными
 * @param первый - id-шаблона
 * @param второй - массив для вывода в админку input[type="text"]
 * @param третий - массив для вывода в глобальную область видимости
 */
create_array($tmpl_id, array(
                                'head_title',// если есть title - выводим классы для центрирования/прописные/строчные  - всё что относится к заголовку имеет в начале "title"
                            ),

                       array(

                            ));


// <div class="' . $section_name . '" id="' . $tmpl_id . '"> передаем id=......$tmpl_id для переадресации к тому же экрану с которого был отправлен запрос
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LPGenerator</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- flexslider -->
    <link rel="stylesheet" href="plugins/flexslider/flexslider.css" type="text/css"/>
    <!-- magnific-popup -->
    <link rel="stylesheet" href="plugins/magnific-popup/magnific-popup.css">
    <!-- fonts css -->
    <link rel="stylesheet" href="css/fonts.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="wrapper__main">
        <div class="content__main">';

return $html;