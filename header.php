<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# <?php if(is_home()){ echo 'fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#'; }else{ echo 'fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#'; } ?>">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width initial-scale=1, user-scalable=yes">
    <?php get_template_part( '_modules_meta' ); ?>
    <?php wp_head();?>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/default.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,500,700&display=swap&subset=japanese" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css?201052" />
</head>

<body class="gf_noto">
    <div class="wrapper" id="top">
        <?php if(is_home()):?>
            <div class="l_row">
                <div class="pTop_mv">
                    <div class="pTop_mv__logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_full.png" alt="熊野曼陀羅"></div>
                </div>
            </div>
        <?php endif;?>
        <header class="md_header" data-role="header">
            <?php if(is_home()):?>
                <h1 class="md_header__logo home"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_blk.png" alt="熊野曼陀羅"></a></h1>
            <?php else:?>
                <p class="md_header__logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_blk.png" alt="熊野曼陀羅"></a></p>
            <?php endif;?>
        </header>

        <main role="main">
