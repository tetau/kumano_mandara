<?php $keyword_default = '' ; ?>
<?php $title_default = '' ; ?>

<?php
    $pageD = get_the_excerpt();
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
<meta property="og:title" content="<?php echo esc_attr($title_default) ; ?>" />
<meta property="og:description" content="<?php bloginfo('description'); ?>"/>
<?php elseif(is_singular( '' )) : ?>
<title><?php the_title(); ?><?php echo esc_attr($sitetitleD); ?></title>
<meta name="description" content="<?php the_title(); ?><?php echo esc_attr($sitetitleD); ?>" />
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:description" content="<?php the_title(); ?><?php echo esc_attr($sitetitleD); ?>"/>
<?php elseif(is_tax( array('','','') ) ) : ?>
<?php
    $desc = term_description();
    $desc = stripslashes(strip_tags(strip_shortcodes($desc)));
    $desc = str_replace(array("\r\n","\r","\n"," ","　"," "), '', $desc );
    $desc = trim($desc);
?>
<title><?php single_term_title(); ?> | <?php echo esc_attr(mb_substr($desc, 0, 40)); ?>...</title>
<meta name="description" content="<?php echo esc_attr(mb_substr($desc, 0, 160)); ?>" />
<?php elseif( is_post_type_archive('')):?>
<title>路線バス | <?php echo esc_attr($sitetitleD); ?></title>
<meta name="description" content="" />
<meta property="og:title" content="<?php echo esc_attr($sitetitleD); ?>" />
<meta property="og:description" content=""/>
<?php elseif( is_archive('article')):?>
<?php
$type = get_post_type_object($post->post_type);
$term_label = single_term_title('', false);
?>
<title><?php if($term_label) {echo esc_attr($term_label);} ?> <?php echo esc_attr($type->label); ?>一覧ページ | <?php echo esc_attr($sitetitleD); ?></title>
<meta name="description" content="<?php echo esc_attr($sitetitleD); ?>の<?php if($term_label) {echo esc_attr($term_label);} ?> <?php echo esc_attr($type->label); ?>一覧ページです" />
<meta property="og:title" content="<?php echo esc_attr($sitetitleD); ?>の<?php if($term_label) {echo esc_attr($term_label);} ?> <?php echo esc_attr($type->label); ?>一覧ページ" />
<meta property="og:description" content="<?php echo esc_attr($sitetitleD); ?>の<?php if($term_label) {echo esc_attr($term_label);} ?> <?php echo esc_attr($type->label); ?>一覧ページ" />
<?php else: ?>
<title><?php the_title(); ?> | <?php echo esc_attr($title_default) ; ?></title>
<meta name="description" content="<?php echo esc_attr(mb_substr($desc, 0, 160)); ?>" />
<?php endif; ?>
<?php if (is_home() || is_front_page()) : ?>
<meta property="og:type" content="website" />
<?php else: ?>
<meta property="og:type" content="article" />
<?php endif; ?>
<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/ogp1200x630.jpg" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:url" content="<?php echo $current_url  ?>" />
<meta property="fb:app_id" content="" />

