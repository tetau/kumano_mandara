<?php

//   ---------------------------------------
//    管理画面関係
//  ----------------------------------------


//   管理画面サイドメニュー
//  ----------------------------------------
    //【管理画面】左メニューadmin以外表示しない
    function remove_menu() {
        if (!current_user_can('administrator')) {
            // remove_menu_page('index.php'); // ダッシュボード
            // remove_menu_page('edit.php'); // 投稿
            // remove_menu_page('edit.php?post_type=news'); // ポストタイプ
            // remove_menu_page('upload.php'); // メディア
            // remove_menu_page('link-manager.php'); // リンク
            // remove_menu_page('edit.php?post_type=page'); // 固定ページ
            // remove_menu_page('edit-comments.php'); // コメント
            // remove_menu_page('themes.php'); // 概観
            // remove_menu_page('plugins.php'); // プラグイン
            // remove_menu_page('users.php'); // ユーザー
            // remove_menu_page('tools.php'); // ツール
            // remove_menu_page('options-general.php'); // 設定
            // remove_menu_page('wpcf7');   //Contact Form 7
            // remove_menu_page('profile.php');   //プロフィール
            // remove_submenu_page('edit.php?post_type={posttype}','post-new.php?post_type={posttype}');   //ポストタイプ
        }
    }
    add_action('admin_menu', 'remove_menu');





//   メニューの「ダッシュボード」項目を非表示にする
//  ----------------------------------------

function example_remove_dashboard_widgets() {
    global $wp_meta_boxes;
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // アクティビティ
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
    }
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');





//   管理画面　各表示関係
//  ---------------------------------------
//【管理画面】フッター表示しない(WordPress のご利用ありがとうございます。)
    function custom_admin_footer() {}
        add_filter('admin_footer_text', 'custom_admin_footer');

//【管理画面】admin_bar項目別に表示しない
    function mytheme_admin_bar_render() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('updates');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
        $wp_admin_bar->remove_node('wp-logo');
    }
    add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

//【管理画面】右サイドのヘルプ非表示
    function disable_help_link() {
        echo '<style type="text/css">#contextual-help-link-wrap {display: none !important;}</style>';
    }
    add_action('admin_head', 'disable_help_link');

// WordPressの更新通知表示と、バージョンチェックを無効
    if( !current_user_can( 'administrator' ) ) {
        add_filter( 'pre_site_transient_update_core', '__return_zero' );
        remove_action( 'wp_version_check', 'wp_version_check' );
        remove_action( 'admin_init', '_maybe_update_core' );
    }






//   エディタ・投稿関係
//  ---------------------------------------

//固定ページではGutenbergを無効
    function disable_block_editor( $use_block_editor, $post_type ) {
        if ( $post_type === 'page' ) return false;
        return $use_block_editor;
    }
    add_filter( 'use_block_editor_for_post_type', 'disable_block_editor', 10, 2 );


//固定ページではビジュアルエディタを利用できないようにする
    function disable_visual_editor_in_page(){
        global $typenow;
        if( $typenow == 'page' ){
        add_filter('user_can_richedit', 'disable_visual_editor_filter');
        }
    }
    function disable_visual_editor_filter(){
        return false;
    }
    add_action( 'load-post.php', 'disable_visual_editor_in_page' );
    add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );


//   ---------------------------------------
//    デフォルト出力関係
//  ----------------------------------------
    //wp_head()のいらないタグを削除
        remove_action('wp_head', 'wp_generator');//バージョン情報
        remove_action('wp_head', 'wlwmanifest_link');// wlwmanifestWindows Live Writerを使った記事投稿URL
        remove_action( 'wp_head', 'rsd_link' );// 外部ツールを使ったブログ更新用のURL
        remove_action('wp_head', 'wp_shortlink_wp_head'); //デフォルトパーマリンクのURL
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); //前の記事と後の記事のURL
        remove_action( 'wp_head', 'feed_links', 2 ); //RSSフィードのURL
        remove_action('wp_head', 'feed_links_extra', 3); //RSSフィードのURL
        remove_action('wp_head','rest_output_link_wp_head');//oEmbed
        remove_action('wp_head','wp_oembed_add_discovery_links');//oEmbed
        remove_action('wp_head','wp_oembed_add_host_js');//oEmbed
    // wp4.2emoji script 除去
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        // DNS prefitch emoji remove
        add_filter( 'emoji_svg_url', '__return_false' );

?>
