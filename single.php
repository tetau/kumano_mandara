<?php get_header(); ?>

<?php
$type = get_post_type_object($post->post_type);
$template_uri = get_template_directory_uri();
?>

<?php if (have_posts()) : ?><?php while ( have_posts() ) : the_post(); ?>
    <article class="sPlace">
        <div class="sPlace_head">
            <div class="l_row mx_1024">
                <div class="l_row pd_side8">
                    <?php
                    $attachment_id = get_field('cf_main__image');
                    if($attachment_id) {
                        $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'original_16-9__lrg' );
                        echo '<figure class="sPlace_hero"><img src="' . esc_html( $thumbnail_src[0] ) . '" class="" alt="' . get_the_title() . '"></figure>';
                    }
                    ?>
                    <header class="sPlace_title__wrap">
                        <?php
                        $cf_number = get_field('cf_number');
                        if($cf_number) {
                            echo '<div class="sPlace_title__num"><span class="fz_14 serif kumano">KUMANO</span><span class="fz_14 serif mandara">MANDARA</span><span class="fz_36 fw700 num">' . esc_attr($cf_number) . '</span></div>';
                        }?>
                        <div class="sPlace_title">
                            <p class="fz_15 tagline">
                                <?php
                                $cf_tagline = get_field('cf_tagline');
                                if($cf_tagline) {
                                    echo '<span>' . esc_attr($cf_tagline) . '</span>';
                                }?>
                                <?php
                                $cf_copy = get_field('cf_copy');
                                if($cf_copy) {
                                    echo '<span>' . esc_attr($cf_copy) . '</span>';
                                }?>
                            </p>
                            <h1 class="sPlace_name">
                                <?php
                                $cf_headtemple = get_field('cf_headtemple');
                                if($cf_headtemple) {
                                    echo '<p class="fz_20 fw700 headtemple"><span>' . esc_attr($cf_headtemple) . '</span></p>';
                                }?>
                                <span class="fz_36 fw700 ttl"><?php the_title();?></span>
                            </h1>
                            <?php
                            $cf_furigana = get_field('cf_furigana');
                            if($cf_furigana) {
                                echo '<p class="fz_16 sPlace_rubi"><span>' . esc_attr($cf_furigana) . '</span></p>';
                            }?>
                        </div>
                    </header>
                    <?php
                    $cf_textarea = get_field('cf_textarea');
                    if($cf_textarea) {
                        echo '<div class="fz_15 sPlace_summary">' . nl2br($cf_textarea) . '</div>';
                    }?>
                </div>
            </div><!-- l_row -->
        </div><!-- sPlace_head -->

        <?php
        $cf_guidance = get_field('cf_guidance');
        $cf_god__category = get_field('cf_god__category');
        ?>
        <?php if ($cf_guidance or $cf_god__category != 'なし') : ?>
            <div class="fz_15 sPlace_section l_border">
                <div class="l_row mx_1024"><div class="l_row pd_side8">
                    <section class="sPlace_column">
                        <?php
                        $cf_guidance = get_field('cf_guidance');
                        if($cf_guidance) {
                            echo '<div class="sPlace_guidance"><h3 class="fz_24 fw700 md_sec__ttl">ご案内</h3>';
                            echo '<p class="fz_15">' . nl2br($cf_guidance) . '</p></div>';
                        }?>
                        <?php
                        $cf_god__name = get_field('cf_god__name');
                        if($cf_god__category != 'なし') {
                            echo '<div class="sPlace_god">';
                            echo '<h3 class="fz_18 fw500 ttl"><span>' . esc_attr($cf_god__category) . '</span></h3>';
                            if($cf_god__name) {
                                echo '<div class="fz_18 fw500 name"><span>' . esc_attr($cf_god__name) . '</span></div>';
                            }
                            echo '</div>';
                            $cf_deity = get_field('cf_deity');
                            if($cf_deity){
                                echo '<div class="sPlace_deity">';
                                echo '<h3 class="fz_16 fw500 ttl"><span>御祭神</span></h3>';
                                echo '<ul class="sPlace_deity__list">';
                                foreach($cf_deity as $deity) {
                                    echo '<li>' . $deity['cf_deity__list'] . '</li>';
                                }
                                echo '</ul>';
                                echo '</div>';
                            }
                        }?>
                    </section>
                </div></div>
            </div>
        <?php endif; ?>


        <div class="fz_15 sPlace_section l_border">
            <div class="l_row mx_1024"><div class="l_row pd_side8">
                <?php if(have_rows('cf_event')): ?>
                    <section class="sPlace_column">
                        <h3 class="fz_24 fw700 md_sec__ttl">主な行事</h3>
                        <ul class="fz_15 sPlace_event__list">
                            <?php while(have_rows('cf_event')): the_row(); ?>
                                <?php
                                $event = get_sub_field('cf_event__list');
                                if($event) {
                                    echo '<li><p>' . esc_attr($event) . '</p></li>';
                                }
                                ?>
                            <?php endwhile; ?>
                        </ul>
                    </section>
                <?php endif; ?>
                <section class="sPlace_column">
                    <ul class="sPlace_suimage">
                        <?php
                        $cf_stamp = get_field('cf_stamp');
                        if($cf_stamp) {
                            $cf_stamp_id = get_field('cf_stamp');
                            if($cf_stamp_id) {
                                echo '<li class="stamp"><figure class="sPlace_stamp">';
                                echo wp_get_attachment_image( $cf_stamp_id, "medium", false);
                                echo '<figure></li>';
                            }
                        }?>
                        <?php if(have_rows('cf_subimage')): ?>
                            <?php while(have_rows('cf_subimage')): the_row(); ?>
                                <?php
                                $attachment_id = get_sub_field('cf_subimage__img');
                                $attachment = get_post( $attachment_id );
                                $post_caption = $attachment->post_excerpt;
                                $full_img = wp_get_attachment_image_src( $attachment_id , 'full' );
                                if($attachment_id) {
                                    echo '<li><a href="' . esc_url( $full_img[0] ) . '" data-fancybox="sub_image">';
                                    echo wp_get_attachment_image( $attachment_id, "original_thumbsq_lrg", false);
                                    echo '</a>';
                                    if($post_caption) {
                                        echo '<p class="sub_image__caption"><span>' . esc_attr($post_caption ) . '</span></p>';
                                    }
                                    echo '</li>';

                                }
                                ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </section>
                <?php if(have_rows('cf_contents')): ?>
                    <section class="sPlace_column">
                        <?php while(have_rows('cf_contents')): the_row(); ?>
                            <div class="sPlace_contents">
                                <?php
                                $contents_ttl = get_sub_field('cf_contents__ttl');
                                $contents_summary = get_sub_field('cf_contents__summary');
                                if($contents_ttl) {
                                    echo '<h3 class="fz_18 fw700 md_sec__ttl sub">' . esc_attr($contents_ttl) . '</h3>';
                                }
                                if($contents_summary) {
                                    echo '<p class="fz_15">' . $contents_summary . '</p>';
                                }
                                ?>
                            </div>
                            <?php endwhile; ?>
                    </section>
                <?php endif; ?>
            </div></div>
        </div>

        <div class="fz_15 sPlace_section l_border">
            <div class="l_row mx_1024"><div class="l_row pd_side8">
                <?php $cf_poetry = get_field('cf_poetry');if($cf_poetry):?>
                <section class="sPlace_column">
                    <h3 class="fz_24 fw700 md_sec__ttl">御歌</h3>
                    <div class="fz_24 serif sPlace_poetry"><?php echo $cf_poetry; ?></div>
                </section>
            <?php endif; ?>

            <section class="sPlace_column">
                <div class="sPlace_info">
                    <h3 class="fz_18 fw700 sPlace_info__ttl"><?php the_title();?>連絡先</h3>
                    <?php
                    $cf_address = get_field('cf_address');
                    if($cf_address) {
                        echo '<p class="fz_15 sPlace_info__cont">' . esc_attr($cf_address) . '</p>';
                    }?>
                    <?php
                    $cf_phone = get_field('cf_phone');
                    if($cf_phone) {
                        echo '<p class="fz_15 sPlace_info__cont">' . esc_attr($cf_phone) . '</p>';
                    }?>
                    <?php if(have_rows('cf_access__col')): ?>
                        <div class="sPlace_access">
                            <h3 class="fz_16 fw700 sPlace_info__ttl">交通のご案内</h3>
                            <?php while(have_rows('cf_access__col')): the_row(); ?>
                                <?php
                                $access_ttl = get_sub_field('cf_access__ttl');
                                $access_summary = get_sub_field('cf_access__summary');
                                if($access_ttl) {
                                    echo '<h4 class="fz_15 fw500 ttl">' . esc_attr($access_ttl) . '</h4>';
                                }
                                if($access_summary) {
                                    echo '<div class="fz_15 summary">' . $access_summary . '</div>';
                                }
                                ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                $cf_gmap = get_field('cf_gmap');
                if($cf_gmap) {
                    echo '<div class="sPlace_gmap">';
                    echo '<iframe src="' . esc_url($cf_gmap) . '" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
                    echo '</div>';
                }?>
            </section>

            <?php
            $nextpost = get_adjacent_post(false, '', true);
            $prevpost = get_adjacent_post(false, '', false);
            if( $prevpost or $nextpost ){ ?>
                <ul class="sPlace_adjacentPost">
                    <?php
                    if ( $prevpost ) {
                        echo '<li class="prevpost"><a href="' . get_permalink($prevpost->ID) . '"><i class="fas fa-arrow-left"></i><span class="fz_30 fw700 num">' . esc_attr($cf_number) . '</span><span class="fz_24 fw500 ttl">' . get_the_title($prevpost->ID) . '</span></a></li>';
                    }
                    if ( $nextpost ) {
                        $cf_number = get_field('cf_number',$nextpost->ID);
                        echo '<li class="nextpost"><a href="' . get_permalink($nextpost->ID) . '"><span class="fz_30 fw700 num">' . esc_attr($cf_number) . '</span><span class="fz_24 fw500 ttl">' . get_the_title($nextpost->ID) . '</span><i class="fas fa-arrow-right"></i></a></li>';
                    }
                    ?>
                </ul>
            <?php } ?>

        </div></div>
    </article>
<?php endwhile; ?><?php endif; ?>


<?php get_footer(); ?>

