<?php get_header();
    $template_uri = get_template_directory_uri();
    if(have_posts()) {
        $type = get_post_type_object($post->post_type);
        $term_object = get_queried_object();
    }
?>

<?php echo esc_attr($term_object->name);?>

<?php if (have_posts()) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php endwhile; ?>
    <?php get_template_part( 'pagenavi' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
