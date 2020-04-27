<!DOCTYPE html>
<html <?php language_attributes(); ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
        
        <meta property="og:locale" content="pt_BR">

        <meta property="og:url" content="http://www.rafaelkeller.com.br">

        <meta property="og:title" content="Rafael Keller - Desenvolvedor Full Stack">
        <meta property="og:site_name" content="Rafael Keller - Desenvolvedor Full Stack">

        <meta property="og:description" content="Desenvolvimento de sites, e-commerce, sistemas web em geral e aplicativos mobile">

        <meta property="og:image" content="<?php echo get_template_directory_uri()?>/images/intro-bg.jpg">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:type" content="website">
        
        <meta name="description" content="">
        <meta name="author" content="">
        
        

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

        <!-- Favicons
            ================================================== -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png"> 
        
        <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery.1.11.1.js"></script>


        <!-- Stylesheet
            ================================================== -->

        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>        

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

        <?php wp_head(); ?>
    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">           