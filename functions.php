<?php

//jquery
wp_enqueue_script('jquery');

// 投稿者アーカイブ非表示リダイレクト
function author_archive_redirect() {
   if( is_author() ) {
       wp_redirect( home_url());
       exit;
   }
}
add_action( 'template_redirect', 'author_archive_redirect' );

//サムネイルサイズ
add_theme_support('post-thumbnails');
add_image_size( 'original_thumbsq_lrg', 500, 500, true );
add_image_size( 'original_4-3__portrait', 600, 800, true );
add_image_size( 'original_4-3__lrg', 1200, 900, true );
add_image_size( 'original_16-9__lrg', 1200, 675, true );


//追加したサイズの挿入
add_filter('image_size_names_choose', 'me_display_image_size_names_muploader', 11, 1);
function me_display_image_size_names_muploader( $sizes ) {
    $new_sizes = array();
    $added_sizes = get_intermediate_image_sizes();
    foreach( $added_sizes as $key => $value) {
        $new_sizes[$value] = $value;
    }
    $new_sizes = array_merge( $new_sizes, $sizes );
    return $new_sizes;
}

//投稿フォーム
add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list',) );
add_theme_support( 'post-formats', array('aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',) );

//投稿ページ 独自css
add_editor_style('assets/css/editor-style.css');
//Guteberg独自css
add_theme_support( 'editor-styles' );

require_once locate_template('function_inc/fun_output-ext.php');             //  テキストなどの出力回り
require_once locate_template('function_inc/fun_posttype.php');               //  ポストタイプ
require_once locate_template('function_inc/fun_getpost.php');                //  pre_get_post
require_once locate_template('function_inc/fun_admin.php');              //  管理画面関係


//管理画面 [設定 - メディア] で指定する 「大サイズ」 の幅の上限
if ( ! isset( $content_width ) ) $content_width = 1200;

//メールの再入力チェック
function wpcf7_main_validation_filter( $result, $tag ) {
  $type = $tag['type'];
  $name = $tag['name'];
  $_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
  if ( 'email' == $type || 'email*' == $type ) {
    if (preg_match('/(.*)_confirm$/', $name, $matches)){
      $target_name = $matches[1];
      if ($_POST[$name] != $_POST[$target_name]) {
        if (method_exists($result, 'invalidate')) {
          $result->invalidate( $tag,"確認用のメールアドレスが一致していません");
      } else {
          $result['valid'] = false;
          $result['reason'][$name] = '確認用のメールアドレスが一致していません';
        }
      }
    }
  }
  return $result;
}

add_filter( 'wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2 );


?>
