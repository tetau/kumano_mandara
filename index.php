<?php get_header(); ?>

<div class="l_row">
    <div class="pd_side8">


                <?php if($terms):?>
                    <ul class="aPlace_area__list">
                        <?php foreach($terms as $term) :?>
                            <li><a href="<?php echo get_term_link($term->slug, $term->taxonomy); ?>"><span><?php echo $term->name; ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?><!-- if($terms) -->

            <?php if(have_posts()) : ?>
                <ul class="aPlace_place__list">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li>
                            <?php
                            $attachment_id = get_field('cf_main__image');
                            if($attachment_id) {
                                $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'original_16-9__lrg' );
                                echo '<a href="' . get_permalink() . '"><figure class="aPlace_place__thumb"><img src="' . esc_html( $thumbnail_src[0] ) . '" class="" alt="' . get_the_title() . '"></figure></a>';
                            }
                            ?>
                            <div class="aPlace_place__head">
                                <h2 class="aPlace_place__ttl"><?php the_title();?></h2>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aut minima delectus ipsum at eos nemo tempora, nisi officia, aliquid, vel et dolore quae neque ut, corrupti eum dicta facere.
    </div>
</div>

<?php get_footer(); ?>


