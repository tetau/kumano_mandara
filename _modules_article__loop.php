
<article class="md_blog__item">
    <a href="<?php the_permalink();?>">
            <?php
            $files = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image");
            $template_uri = get_template_directory_uri();
            $title = get_the_title();
            $link = get_permalink();
            $time = get_the_time('c');
            if(has_post_thumbnail()) {
                the_post_thumbnail('original_stuff', array('alt' =>$title, 'title' => $title, 'class' => 'md_blog__img'));
            } elseif (empty($files)){
                echo '<figure class="md_blog__imgWrap"><img src="' . esc_url($template_uri) .'/images/substitute_720x480.jpg" alt="' . esc_attr($title) . '" class="md_blog__img subsitute" /></figure>';
            } else {
                $keys = array_keys($files);
                $lastkeys = array_pop($keys);
                $num=$lastkeys;
                $thumb=wp_get_attachment_image_src($num, 'original_stuff');
                $thumbsq=wp_get_attachment_image_src($num, 'thumbnail');
                echo '<figure class="md_blog__imgWrap"><img src="' . esc_url($thumb[0]) .'" alt="' . esc_attr($title) . '" class="md_blog__img" /></figure>';
            }?>
    </a>
    <div class="md_blog__cont">
        <time datetime="<?php the_time('c');?> " class="fz_13 md_blog__date"><i class="fa fa-clock-o"></i><?php the_time('Y年m月d日'); ?></time>
        <a href="<?php the_permalink();?>"><h2 class="fz_18 md_blog__ttl"><?php the_title();?></h2></a>
        <p class="fz_14 md_blog__excerpt"><?php echo character_limit(80);?></p>
    </div>
</article>
