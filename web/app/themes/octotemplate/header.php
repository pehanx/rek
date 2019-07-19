<?php
/**
 * The header for our theme
 *
 * @package octotemplate
 */

?>
<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="telephone=no" name="format-detection">
    <!-- This make sence for mobile browsers. It means, that content has been optimized for mobile browsers -->
    <meta name="HandheldFriendly" content="true">


    <!--[if (gt IE 9)|!(IE)]><!-->
    <link href="<?= template(); ?>static/css/main.css" rel="stylesheet" type="text/css">
    <link href="<?= template(); ?>static/css/eventCalendar_theme_responsive.css" rel="stylesheet" type="text/css">
    <link href="<?= template(); ?>static/css/eventCalendar.css" rel="stylesheet" type="text/css">
    <!--<![endif]-->

    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="twitter:description" content="" />
	<title><?php wp_title(); ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?= template(); ?>static/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= template(); ?>static/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= template(); ?>static/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= template(); ?>static/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= template(); ?>static/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= template(); ?>static/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= template(); ?>static/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= template(); ?>static/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= template(); ?>static/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= template(); ?>static/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= template(); ?>static/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= template(); ?>static/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= template(); ?>static/favicon/favicon-16x16.png">
    <meta name="msapplication-TileImage" content="<?= template(); ?>static/favicon/ms-icon-144x144.png">


    <script>
        (function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)
    </script>

</head>

<body class="page">
<?php
get_template_part('/parts/header', 'svgs');

get_template_part('/parts/header', 'menu');
?>

