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
        'supports' => array('title','editor','thumbnail'),
        'has_archive' => 'places',
        'show_in_rest' => true,
    );
    register_post_type('places', $args);
}



// ------ article category ---------//
$args = array(
    'label' => 'カテゴリー',
    'labels' => array(
        'name' => 'カテゴリー',
        'singular_name' => 'カテゴリー',
        'search_items' => 'カテゴリーを検索',
        'popular_items' => 'よく使われているカテゴリー',
        'all_items' => 'すべてのカテゴリー',
        'parent_item' => '親カテゴリー',
        'edit_item' => 'カテゴリーの編集',
        'update_item' => '更新',
        'add_new_item' => '新規カテゴリーを追加',
        'new_item_name' => '新しいカテゴリー',
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
register_taxonomy('places_cat', 'places', $args);



//   ---------------------------------------
//    カスタムポストタイプ 管理画面
//  ----------------------------------------







?>
