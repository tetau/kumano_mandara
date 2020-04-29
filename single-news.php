<?php get_header(); ?>

<?php
$type = get_post_type_object($post->post_type);
$terms = get_the_terms( $post->ID, 'newscat' );
$template_uri = get_template_directory_uri();
 ?>

    <main class="contents_wrap" role="main">

<?php if (have_posts()) : ?>


        <div class="pg_common__head news p_60">
            <div class="innr">
                <div class="pg_common__logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" width="300" alt="田辺観光バス"></div>
                <h2 class="fz_36 fw700 pg_common__ttl">お知らせ</h2>
            </div>
            <nav class="fz_14 pg_common__bread"><span><a href="/">トップ</a></span><span><a href="/news/">お知らせ</a></span><span><?php echo title_character_limit(30);?></span></nav>
        </div>


<?php while ( have_posts() ) : the_post(); ?>

    <div class="single_news__wrapper">

        <section class="single_news__wrap">
            <time datetime="<?php the_time('c');?> " class="fz_16 single_news__date"><?php the_time('Y.m.d'); ?></time>
            <h2 class="fz_36 fw600 single_news__ttl"><?php the_title(); ?></h2>
            <div class="single_news__head">
                <?php
                $terms = get_the_terms( $post->ID, 'newscat' );
                if ($terms && ! is_wp_error($terms)) {
                    foreach($terms as $term):
                        echo '<p class="fz_15 single_news__cat"><a href="' . get_term_link($term) . '">' . esc_attr( $term->name ) . '</a></p>';
                        break;
                    endforeach;
                }
                ?>
            </div>
            <div class="postEntry fz_16 single_news__content">
                <?php the_content(); ?>
            </div>
        </section>

        <?php
            $prev_post = get_adjacent_post(false, '', true);
            $next_post = get_adjacent_post(false, '', false);
        ?>
        <nav class="fz_16 single_news__next">
            <?php if ( $prev_post ) :?>
            <div class="single_news__nextlink previous">
                <a href="<?php the_permalink($prev_post->ID);?>">前の記事</a>
            </div>
            <?php endif; ?>
            <?php if ( $next_post ) :?>
            <div class="single_news__nextlink next">
                <a href="<?php the_permalink($next_post->ID);?>">次の記事</a>
            </div>
            <?php endif; ?>
        </nav>
    </div>



    <?php endwhile; ?>
<?php endif; ?>


</div>

<?php get_footer(); ?>

