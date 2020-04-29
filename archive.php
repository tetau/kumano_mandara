<?php if (is_author()) : ?>
    <?php header("HTTP/1.0 404 Not Found");get_template_part('404'); ?>

<?php elseif (is_date()) : ?>
    <?php get_header(); ?>

    <?php if (is_day()) : ?><?php the_time('Y.m.d'); ?>
    <?php elseif (is_month()) : ?><?php the_time('Y.m'); ?>
    <?php elseif (is_year()) : ?><?php the_time('Y'); ?>
    <?php endif; ?>

        <?php if(have_posts()) : ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( '_modules_article__loop' ); ?>
            <?php endwhile; ?>

            <?php get_template_part( 'pagenavi' ); ?>

        <?php endif; ?>

        <section class="">
            <h2 class="">カテゴリー</h2>
            <ul class="">
                <?php wp_list_categories('taxonomy=category&title_li=&depth=1&hide_empty=1&show_count=0'); ?>
            </ul>
        </section>
        <section class="">
            <h2 class="">月別アーカイブ</h2>
            <ul class="">
                <?php wp_get_archives('post_type=post&type=monthly&show_post_count=1&limit=12'); ?>
            </ul>
        </section>

<?php elseif (is_tax('faqcat')) : ?>

<?php else : ?>

    <?php if(have_posts()) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_title(); ?>
        <?php endwhile; ?>
    <?php endif; ?>

<?php get_header(); ?>

<div class="contents_wrapper">
    <section class="md_pageHeader page__error">
        <h2 class="md_pageHeader__Title">お探しのページが見つかりません。</h2>
        <div class="md_pageHeader__description">
            <p>大変申し訳ございません。お客さまがお探しのページを見つけることができませんでした。<br>お探しのページはアクセスできない状況にあるか、移動もしくは削除された可能性があります。</p>
        </div>
    </section>
</div>

<?php endif; ?>


<?php get_footer(); ?>

