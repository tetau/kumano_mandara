<?php $keyword_default = '' ; ?>
<?php $title_default = '熊野曼陀羅' ; ?>

<?php
    $pageD = get_field('cf_textarea');
    $titleD = get_the_title();
    $sitetitleD = get_bloginfo('name');
    if($pageD){
        $desc = $pageD;
    }
    elseif(!empty($post->post_content)){
        $desc = $post->post_content;
    } else {
        $desc = $sitetitleD . 'の' . $titleD . 'ページです。' .get_bloginfo('description');
    }
    $desc = stripslashes(strip_tags(strip_shortcodes($desc)));
    $desc = str_replace(array("&nbsp;","\r\n","\r","\n"," ","　","   "), '', $desc );
    $desc = trim($desc);
?>
<?php if (is_home() || is_front_page()) : ?>
<title><?php echo esc_attr($title_default) ; ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php elseif(is_singular( '' )) : ?>
<title><?php the_title(); ?> | <?php echo esc_attr($sitetitleD); ?></title>
<meta name="description" content="<?php echo esc_attr(mb_substr($desc, 0, 160)); ?>" />
<?php elseif(is_tax('area') ) : ?>
<?php
    $desc = term_description();
    $desc = stripslashes(strip_tags(strip_shortcodes($desc)));
    $desc = str_replace(array("\r\n","\r","\n"," ","　"," "), '', $desc );
    $desc = trim($desc);
?>
<title><?php single_term_title(); ?> | <?php echo esc_attr($sitetitleD); ?></title>
<meta name="description" content="<?php single_term_title(); ?>" />
<?php elseif( is_post_type_archive('places')):?>
<title>熊野三十三ヶ所 | <?php echo esc_attr($sitetitleD); ?></title>
<meta name="description" content="熊野三十三ヶ所" />
<?php endif; ?>

