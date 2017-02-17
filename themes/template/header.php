<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Important Meta -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

    <!-- Website Title ~ Description -->
    <title><?php bloginfo('name'); ?></title>
    <meta name="description" content="">

    <!-- Custom Icons  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" title="FontAwesome">

    <!-- WordPress Defaults -->
    <?php wp_head(); ?>
</head>
<body>

    <header id="site-header">
        <h1><?php bloginfo( 'name' ); ?></h1>
    </header>