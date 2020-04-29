<?php get_header(); ?>

<?php
    $type = get_post_type_object($post->post_type);
    $template_uri = get_template_directory_uri();
?>


<div class="contents_wrapper">

<?php if (have_posts()) : ?>
<?php while ( have_posts() ) : the_post(); ?>


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


<?php
    for($i=1;$i<=5;$i++) {
        $cf_contents__ttl = get_field('cf_contents__ttl'.$i.'');
        if($cf_contents__ttl) {
            $cf_contents = get_field('cf_contents'.$i.'');
            echo '<p class="fz_20"><span>' . esc_attr($cf_contents__ttl) . '</span></p>';
            echo '<p class="fz_15"><span>' . $cf_contents . '</span></p>';
        } else {
            break;
        }
    }?>

    <?php
    $cf_poetry = get_field('cf_poetry');
    if($cf_poetry) {
        echo '<div class="fz_15 serif">' . $cf_poetry . '</div>';
    }?>





    <?php
    $attachment_id = get_field('cf_main__image');
    if($attachment_id) {
        $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
        echo '<img src="' . esc_html( $thumbnail_src[0] ) . '" class="thumb" width="150">';
    }
    ?>
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

    <aside class="p_singleArticle__footer">
        <div class="sns_section post">
            <div class="sns_wrap">
                <span id="score-facebook" class="snsbtn count_mode">
                    <div class="fb-like" data-href="<?php echo the_permalink(); ?>" data-send="false" data-layout="box_count" data-show-faces="false" data-share="false"></div>
                </span>
                <span id="score-facebook" class="snsbtn icon_mode facebook">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(the_permalink()); ?>" class="btn" target="_blank">
                        <i class="icn fab fa-facebook-f"></i><span class="txt">シェア</span>
                    </a>
                </span>
                <span id="score-twitter" class="snsbtn icon_mode twitter">
                    <a href="//twitter.com/share?url=<?php echo urlencode(the_permalink()); ?>&amp;text=<?php echo urlencode(bloginfo('name')); ?><?php echo urlencode(the_title()); ?>" class="btn" target="_blank">
                        <i class="icn fab fa-twitter"></i><span class="txt">シェア</span>
                    </a>
                </span>
                <span id="score-google" class="snsbtn icon_mode google">
                    <a href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>" class="btn" target="_blank">
                        <i class="icn fab fa-google-plus-g"></i><span class="txt">シェア</span>
                    </a>
                </span>
                <span id="score-line" class="snsbtn icon_mode line">
                    <a href="http://line.me/R/msg/text/?<?php echo urlencode(bloginfo('name')); ?><?php echo urlencode(the_title()); ?><?php echo urlencode(the_permalink()); ?>" class="btn" target="_blank">
                        <i class="icn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/line_wh.svg" width="30" alt="line"></i><span class="txt">シェア</span>
                    </a>
                </span>
            </div>
        </div>
    </aside>


    <?php endwhile; ?>
<?php endif; ?>


</div><!-- contents_wrapper -->


<?php get_footer(); ?>

