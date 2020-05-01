<?php

//   ---------------------------------------
//    pre_get_posts
//  ----------------------------------------

function custom_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
    return;
    if ( $query->is_home() ) {
        $query->set( 'post_type', 'places' );
        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'asc' );
    return;
    }
    if ( $query->is_post_type_archive('place') ) {
        $query->set( 'post_type', 'places' );
        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'asc' );
    return;
    }
    if ( $query->is_tax('area') ) {
        $query->set( 'post_type', 'places' );
        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'asc' );
    return;
    }

}
add_action( 'pre_get_posts', 'custom_query' );
?>
