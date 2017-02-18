<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Important Meta -->
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Site Title -->
    <title><?php echo bloginfo( 'name' ); ?> | <?php echo the_title(); ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- WordPress Stuff -->
    <?php wp_head(); ?>

    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>

    <!-- Site Container -->
    <div id="site-container" class="container">


        <header id="site-header">
            <h1><?php bloginfo( 'name' ); ?></h1>
        </header>
