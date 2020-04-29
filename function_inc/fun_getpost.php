<?php

//   ---------------------------------------
//    pre_get_posts
//  ----------------------------------------

function custom_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
    return;
    if ( $query->is_home() ) { // ホーム
        $query->set( 'post_type', 'article' );
        $query->set( 'posts_per_page', 4 );
        $query->set( 'ignore_sticky_posts', 1 );
        $query->set( 'orderby', 'date' );
        $query->set( 'order', 'desc' );
    return;
    }
}
add_action( 'pre_get_posts', 'custom_query' );
?>
