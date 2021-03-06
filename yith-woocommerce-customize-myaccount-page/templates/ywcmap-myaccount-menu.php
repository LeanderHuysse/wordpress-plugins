<?php
/**
 * MY ACCOUNT TEMPLATE MENU
 *
 * @since 1.1.0
 */
if ( ! defined( 'YITH_WCMAP' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce, $wp, $post;

// TODO gET active endpoint

?>

<div class="user-profile">

    <div class="user-image">
        <?php
            $current_user = wp_get_current_user();
            $user_id = $current_user->ID;
            echo get_avatar( $user_id, 120 );
        ?>
        <?php if( $avatar ) : ?>
            <a href="#yith-wcmap-avatar-form" id="load-avatar" data-rel="prettyPhoto[yith-wcmap-avatar-form]">
                <i class="fa fa-camera"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="user-info">
        <p class="username"><?php echo $current_user->display_name ?> </p>
        <?php if( isset( $current_user ) && $current_user->ID != 0 ) : ?>
            <span class="logout"><a href="<?php echo wc_get_endpoint_url( 'customer-logout', '',  $my_account_url ); ?>"><?php _e( 'Logout', 'yith-woocommerce-customize-myaccount-page' ) ?></a></span>
        <?php endif; ?>
    </div>

</div>

<ul class="myaccount-menu">

    <?php foreach( $endpoints as $endpoint => $options ) {

        if( isset( $options['children'] ) ) {
            /**
             * Print endpoints group
             */
            do_action( 'yith_wcmap_print_endpoints_group', $endpoint, $options );
        }
        else {
            /**
             * Print single endpoint
             */
            do_action('yith_wcmap_print_single_endpoint', $endpoint, $options );
        }
    } ?>

</ul>

<?php if( $avatar ) : ?>
    <div id="yith-wcmap-avatar-form" style="display: none;">
        <h3><?php _e( 'Upload your avatar', 'yith-woocommerce-customize-myaccount-page') ?></h3>
        <form enctype="multipart/form-data" method="post">
            <p>
                <input type="file" name="ywcmap_user_avatar" id="ywcmap_user_avatar" accept="image/*">
            </p>
            <p class="submit">
                <input type="submit" class="button" value="<?php _e( 'Upload', 'yith-woocommerce-customize-myaccount-page' ) ?>">
            </p>
            <input type="hidden" name="action" value="wp_handle_upload">
            <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('wp_handle_upload') ?>">
        </form>
        <form enctype="multipart/form-data" method="post">
            <p class="submit" style="margin-top: 15px;">
                <input type="submit" class="button" value="<?php _e( 'Reset to defaults', 'yith-woocommerce-customize-myaccount-page' ) ?>">
            </p>
            <input type="hidden" name="action" value="ywcmap_reset_avatar">
        </form>
    </div>
<?php endif;