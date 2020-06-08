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
    <link href="<?= template(); ?>static/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?= template(); ?>static/css/eventCalendar_theme_responsive.css" rel="stylesheet" type="text/css">
    <link href="<?= template(); ?>static/css/eventCalendar.css" rel="stylesheet" type="text/css">
    <link href="<?= template(); ?>static/css/select2.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> 
    <!--<![endif]-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="<?= template(); ?>static/css/profile_style.css" rel="stylesheet" type="text/css">

    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="http://russianexport.club/app/uploads/2019/11/emblema-polnotsvet-1.png" />
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
    

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->

    <script>
        (function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(55383022, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/55383022" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- <script charset="UTF-8" src="//cdn.sendpulse.com/js/push/faf6ae711b878282ae3a47e340f0c859_1.js" async></script> -->

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1608065032669003');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=1608065032669003&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body class="page">
    <!-- <embed src="https://russianexport.club/app/uploads/2019/12/SHtraus.mp3" autostart="true" hidden="false" loop="false" width="300" height="65" align="bottom" style="visibility: hidden; display: block;"> </embed> -->
<?php
get_template_part('/parts/header', 'svgs');

get_template_part('/parts/header', 'menu');
?>

