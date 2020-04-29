<div class="md_article__pagenav">
    <div class="l_row">
        <nav id="pagenavi">
        <?php global $wp_rewrite;
        $paginate_base = get_pagenum_link(1);
        if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
            $paginate_format = '';
            $paginate_base = add_query_arg('paged', '%#%');
        } else {
            $paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
            user_trailingslashit('page/%#%/', 'paged');;
            $paginate_base .= '%_%';
        }
        echo paginate_links( array(
            'base' => $paginate_base,
            'format' => $paginate_format,
            'total' => $wp_query->max_num_pages,
            'end_size' => 0,
            'mid_size' => 2,
            'current' => ($paged ? $paged : 1),
            'prev_next' => false,
            'type' => 'list',
        )); ?>
        </nav>
    </div>
</div>

