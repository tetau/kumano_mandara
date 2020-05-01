<?php get_header(); ?>

<div class="aPlace">
    <div class="l_row mx_1024">
        <div class="l_row pd_side8">
            <div class="aPlace_head">
                <h1 class="fz_30 lt1 fw700 aPlace_ttl">熊野三十三ヶ所</h1>
                <?php if(is_tax()):?><h2 class="fz_18 fw700 aPlace_termTtl"><span><?php single_term_title(); ?></span></h2><?php endif; ?>
                <?php if(is_post_type_archive('places')):?>
                    <?php
                    $args = array(
                        'taxonomy' => 'area',
                        'orderby' => 'menu_order',
                        'hide_empty' => false,
                    );
                    $terms = get_terms($args);
                    ?>
                    <?php if($terms):?>
                        <ul class="aPlace_area__list">
                            <?php foreach($terms as $term) :?>
                                <li class="fz_16 fw700"><a href="<?php echo get_term_link($term->slug, $term->taxonomy); ?>"><?php echo $term->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?><!-- if($terms) -->
                <?php endif; ?>
            </div>
            <?php if(have_posts()) : ?>
                <ul class="aPlace_place__list">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li>
                            <?php
                            $attachment_id = get_field('cf_main__image');
                            $cf_number = get_field('cf_number');
                            if($attachment_id) {
                                $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'original_16-9__lrg' );
                                echo '<a href="' . get_permalink() . '"><figure class="aPlace_place__thumb"><img src="' . esc_html( $thumbnail_src[0] ) . '" class="" alt="' . get_the_title() . '"></figure></a>';
                                if($cf_number) {
                                    echo '<div class="aPlace_place__num"><span class="fz_20 fw700 num">' . esc_attr($cf_number) . '</span></div>';
                                }
                            }
                            ?>
                            <div class="aPlace_place__head">
                                <?php
                                $cf_copy = get_field('cf_copy');
                                if($cf_copy) {
                                    echo '<p class="fz_14 fw500 copy">' . esc_attr($cf_copy) . '</p>';
                                }?>
                                <h2 class="fz_18 fw700 aPlace_place__ttl"><?php the_title();?></h2>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <?php if(is_tax('area')):?>
                <?php
                $args = array(
                    'taxonomy' => 'area',
                    'orderby' => 'menu_order',
                    'hide_empty' => false,
                );
                $terms = get_terms($args);
                ?>
                <?php if($terms):?>
                    <ul class="aPlace_area__list">
                        <?php foreach($terms as $term) :?>
                            <li class="fz_16 fw700"><a href="<?php echo get_term_link($term->slug, $term->taxonomy); ?>"><?php echo $term->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?><!-- if($terms) -->
                <?php endif; ?>


        </div><!-- pd_side8 -->
    </div><!-- l_row -->
</div><!-- aPlace -->












<?php get_footer(); ?>

