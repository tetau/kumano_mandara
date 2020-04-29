<?php

//   ---------------------------------------
//    テキスト出力
//  ----------------------------------------

    //続きを読む
    function hacca_continue_reading_link() {
        return ' <a href="'. get_permalink() . '" class="readmore">続きを読む</a>';
    }
    function hacca_auto_excerpt_more( $more ) {
        return ' &hellip;' . hacca_continue_reading_link();
    }
    add_filter( 'excerpt_more', 'hacca_auto_excerpt_more' );


    //excerpt文字数
    function char_length() {
        return 50;
    }
    add_filter( 'excerpt_mblength', 'char_length' );

    //本文文字数出力 $lengthには任意の出力したい文字数を入れる
    //php echo title_character_limit(40);
    function character_limit($length) {
        global $post;
        $content_f = get_the_content();
        $content_f = strip_tags(strip_shortcodes($content_f));
        if (mb_strlen($content_f,'utf-8') > $length ) {
            $content_f = mb_substr(strip_tags($content_f),0,$length,'utf-8').'…';
        }
        return $content_f;
    }

    //タイトル文字数出力 $lengthには任意の出力したい文字数を入れる
    function title_character_limit($ttl_length) {
        global $post;
        $title_f = get_the_title();
        if (mb_strlen($title_f,'utf-8') > $ttl_length ) {
            $title_f = mb_substr(strip_tags($title_f),0,$ttl_length,'utf-8').'…';
        }
        return $title_f;
    }



//   ---------------------------------------
//    ページネーション
//  ----------------------------------------

    //ページ番号の表示
    function show_page_number() {
        global $wp_query;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        echo $paged;
    }



//   ---------------------------------------
//    term出力
//  ----------------------------------------

    //termのリンクなし出力
    function get_the_term_list_nolink( $id = 0, $taxonomy, $before = '', $sep = '', $after = '' ) {
        $terms = get_the_terms( $id, $taxonomy );
        if ( is_wp_error( $terms ) )
            return $terms;
        if ( empty( $terms ) )
            return false;
        foreach ( $terms as $term ) {
            $term_names[] =  $term->name ;
        }
        return $before . join( $sep, $term_names ) . $after;
    }



//   ---------------------------------------
//    画像出力
//  ----------------------------------------

    //attachment リンクのページを生成しない制御
    function sar_attachment_redirect() {
        global $post;
        if ( is_attachment() && isset($post->post_parent) && is_numeric($post->post_parent) && ($post->post_parent != 0) ) {
            wp_redirect(get_permalink($post->post_parent), 301);
            exit;
        } elseif ( is_attachment() && isset($post->post_parent) && is_numeric($post->post_parent) && ($post->post_parent < 1) ) {
            wp_redirect(get_bloginfo('wpurl'), 302);
            exit;
        }
    }
    add_action('template_redirect', 'sar_attachment_redirect',1);


    //wp_get_archivesにクラスを指定（lightbox的なことに必要）
    function my_archives_link($link_html){
        $link_html = preg_replace('@<li>@i', '<li class="archives_link">', $link_html);
        return $link_html;
    }
    add_filter('get_archives_link', 'my_archives_link');


//   ---------------------------------------
//    ギャラリー、lightbox絡み
//  ----------------------------------------
    //記事内の画像リンクaタグにクラスを指定
    function linkclass_filter( $content ) {
        global $post;
        preg_match_all('/<a.*?<\/a>/i', $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $def_link) {
            $link = $def_link[0];
            if ( preg_match('/<a.*?>.*?<img.*?>.*?<\/a>/i', $link) ) { //画像を含むとき
                $link = preg_replace('/<img(.*?)src=[\'"]([^\'"]+)\.(bmp|gif|jpeg|jpg|png)[\'"](.*?)>/i', '<img$1src="$2#p#$3"$4>', $link); //画像srcのエスケープ
                $link = preg_replace('/<img(.*?)class=(.*?)>/i', '<img$1cl#a#ss=$2>', $link); //画像classのエスケープ
                $linkclass = 'image-link'; //画像リンクにつけるクラス
            } else {
                $linkclass = 'text-link'; //テキストリンクにつけるクラス
            }
            if ( preg_match('/<a.*?href=[\'"]([^\'"]+)\.(bmp|gif|jpeg|jpg|png)[\'"].*?>/i', $link) ) { //リンク先が画像のとき
                $linkclass .= ' lightbox'; //ライトボックスなどのjs用のクラス
                $linkrel = ' rel="lightbox-'.$post->ID.'"'; //任意のデータやrelを持たせる処理
            } else {
                $linkrel = '';
            }
            if ( preg_match('/<a.*?class=.*?href=.*?>.*?<\/a>/i', $link) || preg_match('/<a.*?href=.*?class=.*?>.*?<\/a>/i', $link) ) {//aタグにclassがあるとき
                $link = preg_replace('/<a(.*?)class="(.*?)"(.*?)>/i', '<a$1class="'.$linkclass.' $2"$3'.$linkrel.'>', $link);  //aタグにclassを追加
            } else {
                $link = preg_replace('/<a(.*?)>/i', '<a class="'.$linkclass.'"$1'.$linkrel.'>', $link); //aタグにclassを付与
            }
            $link = str_replace( array('#p#','#a#'), array('.','a'), $link); //エスケープ解除
            $content = str_replace( $def_link[0], $link, $content );
        }
        return $content;
    }
    add_filter('the_content','linkclass_filter');

    //ギャラリー内の画像リンクaタグにクラスを指定
    function add_rel_to_gallery($link) {
        return str_replace('<a href=', '<a class="lightbox" rel="group-gallery" href=', $link);
    }
    add_filter( 'wp_get_attachment_link', 'add_rel_to_gallery', 10, 2 );


    //デフォルトのギャラリーcss削除
    add_filter(
        "use_default_gallery_style",
        "disable_default_gallery_style"
    );
    function disable_default_gallery_style() {
        return false;
    }

    //ギャラリーのリンク先をデフォルトでメディアファイルに変更
    function image_gallery_default_link( $settings ) {
        $settings['galleryDefaults']['link'] = 'file';
        return $settings;
    }
    add_filter( 'media_view_settings', 'image_gallery_default_link');



//   ---------------------------------------
//    ショートコード
//  ----------------------------------------
    //親テーマURL
    add_shortcode('gtdu', 'shortcode_gtdu');
    function shortcode_gtdu() {
        return get_template_directory_uri();
    }

    // コメントアウト[ignore][/ignore]
    function ignore_shortcode( $atts, $content = null ) {
        return null;
    }
    add_shortcode('ignore', 'ignore_shortcode');

    //homeをショートコード化
    function shortcode_url() {
        return home_url();
    }
    add_shortcode('url', 'shortcode_url');

    //template_directoryをショートコード化
    function shortcode_templateurl() {
        return get_template_directory_uri();
    }
    add_shortcode('template_url', 'shortcode_templateurl');


?>
