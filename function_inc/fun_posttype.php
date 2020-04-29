<?php

//   ---------------------------------------
//    カスタムポストタイプ設定
//  ----------------------------------------

// ------ article posttype---------//
add_action( 'init', 'create_post_type_places' );
function create_post_type_places() {
    $args = array(
        'label' => '神社仏閣',
        'labels' => array(
            'singular_name' => '神社仏閣',
            'add_new_item' => '神社仏閣の新規作成',
            'add_new' => '新規作成',
            'new_item' => '新規作成',
            'view_item' => '記事を表示',
            'not_found' => '見つかりません',
            'not_found_in_trash' => 'ゴミ箱にはありません',
            'search_items' => '検索',
        ),
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => 'places', 'with_front' =>false ),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-aside',
        'supports' => array('title'),
        'has_archive' => 'places',
        'show_in_rest' => true,
    );
    register_post_type('places', $args);
}



// ------ article category ---------//
$args = array(
    'label' => 'エリア',
    'labels' => array(
        'name' => 'エリア',
        'singular_name' => 'エリア',
        'search_items' => 'エリアを検索',
        'popular_items' => 'よく使われているエリア',
        'all_items' => 'すべてのエリア',
        'parent_item' => '親エリア',
        'edit_item' => 'エリアの編集',
        'update_item' => '更新',
        'add_new_item' => '新規エリアを追加',
        'new_item_name' => '新しいエリア',
    ),
    'public' => true,
    'show_ui' => true,
    'hierarchical' => true,
    'rewrite' => array(true, 'with_front' => false),
    'show_in_rest' => true,
    'capabilities' => array(
        'assign_terms' => 'edit_others_posts',
        'edit_terms' => 'edit_others_posts'
    )
);
register_taxonomy('area', 'places', $args);



//   ---------------------------------------
//    カスタムポストタイプ 管理画面
//  ----------------------------------------

        function manage_places_posts_columns($columns) {
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'title' => 'タイトル',
                'col_num' => '番号',
                'area' => 'エリア',
                'thumbnail' => 'サムネイル',
                'modified_date' => '最終更新日',
            );
            return $columns;
        }
        function add_column_places($column_name, $post_id) {
            if( $column_name == 'col_num' ) {
                $col_num = get_field('cf_number');
                echo esc_attr($col_num) . '番';
            }
            if( $column_name == 'thumbnail' ) {
                if(has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail', array('style' =>'width:60px;height:auto;'));
                }
            }
            if( $column_name == 'area' ) {
                echo get_the_term_list_nolink($post_id, 'area','',' , ','');
            }
            if( $column_name == 'thumbnail' ) {
                if(get_field('cf_main__image')) {
                    $thumb_id = get_field('cf_main__image');
                    echo wp_get_attachment_image($thumb_id,array(60, 60));
                }
            }
            if( $column_name == 'modified_date' ) {
                $modified_date = the_modified_date( 'Y年Md日' );
            }
        }
        add_filter( 'manage_places_posts_columns', 'manage_places_posts_columns' );
        add_action( 'manage_posts_custom_column', 'add_column_places', 10, 2 );



?>
