<?php

//   ---------------------------------------
//    pre_get_posts
//  ----------------------------------------

function custom_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
    return;
    if ( $query->is_home() ) { // ホーム
        $query->set( 'post_type', 'place' );
        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'desc' );
    return;
    }
    if ( $query->is_post_type_archive('place') ) { // ホーム
        $query->set( 'post_type', 'place' );
        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'desc' );
    return;
    }
    if ( $query->is_tax('area') ) { // ホーム
        $query->set( 'post_type', 'place' );
        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'desc' );
    return;
    }

}
add_action( 'pre_get_posts', 'custom_query' );
?>
