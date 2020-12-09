<?php
/**
 * Sidebar Template
 */

if (is_active_sidebar('primary_widget_area') || is_archive() || is_single()) :

    ?>
    <div id="sidebar" class="col-md-2 order-md-first col-sm-12 oder-sm-last">
        <?php
        if (is_active_sidebar('primary_widget_area')) :
            ?>
            <div id="widget-area" class="widget-area" role="complementary">
                <?php
                dynamic_sidebar('primary_widget_area');

                if (current_user_can('manage_options')) :
                    ?>
                    <span class="edit-link"><a href="<?php echo esc_url(admin_url('widgets.php')); ?>"
                                               class="badge badge-secondary"><?php _e('Edit', 'fnote'); ?></a></span><!-- Show Edit Widget link -->
                <?php
                endif;
                ?>
            </div><!-- /.widget-area -->
        <?php
        endif;

        if (is_archive() || is_single()) :
            ?>
            <div class="bg-faded sidebar-nav">
                <div id="primary-two" class="widget-area">
                </div><!-- /#primary-two -->
            </div>
        <?php
        endif;
        ?>
    </div><!-- /#sidebar -->
<?php
endif;
?>
