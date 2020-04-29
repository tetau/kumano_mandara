<?php get_header(); ?>

<?php
    $type = get_post_type_object($post->post_type);
    $template_uri = get_template_directory_uri();
?>

<article class="sPlace">
    <div class="l_row mx_1024">
        <div class="pd_side8">
            <?php if (have_posts()) : ?><?php while ( have_posts() ) : the_post(); ?>
                <?php
                $attachment_id = get_field('cf_main__image');
                if($attachment_id) {
                    $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'original_16-9__lrg' );
                    echo '<figure class="sPlace_hero"><img src="' . esc_html( $thumbnail_src[0] ) . '" class="" alt="' . get_the_title() . '"></figure>';
                }
                ?>


    <?php
    $cf_number = get_field('cf_number');
    if($cf_number) {
        echo '<h3 class="fz_24">熊野曼陀羅第<span class="">' . esc_attr($cf_number) . '</span>番</h3>';
    }?>

    <?php
    $cf_heritage = get_field('cf_heritage');
    if($cf_heritage) {
        echo '<p class="fz_20"><span>世界遺産</span></p>';
    }?>

    <h1 class="fz_30 fw700 "><?php the_title();?></h1>

    <?php
    $cf_furigana = get_field('cf_furigana');
    if($cf_furigana) {
        echo '<p class="fz_20"><span>（' . esc_attr($cf_furigana) . '）</span></p>';
    }?>

    <?php
    $cf_headtemple = get_field('cf_headtemple');
    if($cf_headtemple) {
        echo '<p class="fz_20"><span>' . esc_attr($cf_headtemple) . '</span></p>';
    }?>

    <?php
    $cf_copy = get_field('cf_copy');
    if($cf_copy) {
        echo '<p class="fz_20"><span>' . esc_attr($cf_copy) . '</span></p>';
    }?>

    <?php
    $cf_tagline = get_field('cf_tagline');
    if($cf_tagline) {
        echo '<p class="fz_20"><span>' . esc_attr($cf_tagline) . '</span></p>';
    }?>

    <?php
    $cf_textarea = get_field('cf_textarea');
    if($cf_textarea) {
        echo '<p class="fz_15"><span>' . $cf_textarea . '</span></p>';
    }?>


    <?php if(have_rows('cf_contents')): ?>
        <ul class="">
            <?php while(have_rows('cf_contents')): the_row(); ?>
                <?php
                $contents_ttl = get_sub_field('cf_contents__ttl');
                $contents_summary = get_sub_field('cf_contents__summary');
                if($contents_ttl) {
                    echo '<p class="fz_20"><span>' . esc_attr($contents_ttl) . '</span></p>';
                }
                if($contents_summary) {
                    echo '<p class="fz_20"><span>' . $contents_summary . '</span></p>';
                }
                ?>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>

    <?php if(have_rows('cf_event')): ?>
        <ul class="">
            <?php while(have_rows('cf_event')): the_row(); ?>
                <?php
                $event = get_sub_field('cf_event__list');
                if($contents_ttl) {
                    echo '<p class="fz_20"><span>' . esc_attr($event) . '</span></p>';
                }
                ?>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>


    <?php if(have_rows('cf_subimage')): ?>
        <ul class="">
            <?php while(have_rows('cf_subimage')): the_row(); ?>
                <?php
                $attachment_id = get_sub_field('cf_subimage__img');
                $full_img = wp_get_attachment_image_src( $attachment_id , 'full' );
                if($attachment_id) {
                    echo '<li><a href="' . esc_url( $full_img[0] ) . '" data-fancybox="ff_' . esc_attr($day) . '">';
                    echo wp_get_attachment_image( $attachment_id, "thumbnail", false);
                    echo '</a></li>';
                }
                ?>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>


    <?php
    $cf_poetry = get_field('cf_poetry');
    if($cf_poetry) {
        echo '<div class="fz_15 serif">' . $cf_poetry . '</div>';
    }?>

    <?php
    $cf_gmap = get_field('cf_gmap');
    if($cf_gmap) {
        echo '<div class="sPlace_gmap">';
        echo '<iframe src="' . esc_url($cf_gmap) . '" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
        echo '</div>';
    }?>



    <article class="p_singleArticle">
        <div class="p_singleArticle__row">
            <figure class="p_singleArticle__Eyecatch">
                <?php
                    if(has_post_thumbnail()) {
                        the_post_thumbnail('original_4-3__lrg', array('alt' =>$title, 'title' => $title, 'class' => 'p_singleArticle__eyeImg'));
                    }
                ?>
            </figure>
            <div class="p_singleArticle__header">
            <?php if(has_term('','articlecat')): ?>
            <?php
                $args = array(
                    'orderby' => 'term_order'
                );
                $article_terms = wp_get_object_terms($post->ID, array( 'articlecat'), $args );
                if(!empty($article_terms)){
                        if(!is_wp_error( $article_terms )){
                                foreach($article_terms as $term){
                                        echo '<span class="gf_robotoslab fw700 lt2 fz_13 p_singleArticle__mainterm">'.$term->slug.'</span>';
                                }
                        }
                }
            ?>
            <?php endif; ?>
            <time datetime="<?php the_time('c');?> " class="fz_12 p_singleArticle__date"><?php echo get_post_time('M j, Y'); ?></time>
            <h2 class="fz_30 fw700 p_singleArticle__ttl"><?php the_title();?></h2>
            <?php
                $articletags = get_the_terms($post->ID, 'articletag');
                //タームとURLを出力
                if(!empty($articletags)){
                        if(!is_wp_error( $articletags )){
                                echo '<ul class="fz_13 p_singleArticle__tag">';
                                foreach($articletags as $articletag){
                                        echo '<li><a href="'.get_term_link($articletag->slug, $articletag->taxonomy).'">'.$articletag->name.'</a></li>';
                                }
                                echo '</ul>';
                        }
                }
            ?>
            </div>

            <div class="fz_16 postEntry p_singleArticle__postEntry">
                <?php the_content(); ?>
            </div>
        </div>
    </article>




            <?php endwhile; ?><?php endif; ?>
        </div><!-- pd_side8 -->
    </div><!-- l_row -->
</article>

<?php get_footer(); ?>

