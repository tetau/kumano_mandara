</main><!-- main -->
</div><!-- .wrapper-->

<footer>
    <div class="md_footer p_60" role="contentinfo">
        <div class="l_row pd_side">
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<?php if(is_home()): ?><?php endif; ?>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>

<?php if(is_page(array('contact','tour_reservation'))): ?>
    <?php if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
        wpcf7_enqueue_styles();
    }?>
<?php endif; ?>

</body>
</html>

