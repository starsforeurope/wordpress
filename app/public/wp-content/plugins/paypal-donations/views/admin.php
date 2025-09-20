<!-- Create a header in the default WordPress 'wrap' container -->
<div class="wrap">
    <h2><?php esc_html_e( 'PayPal Donations', 'paypal-donations' ); ?></h2>

    <div style="background:#FFF6D5;border: 1px solid #D1B655;color: #3F2502;margin: 10px 0;padding: 5px 5px 5px 10px;text-shadow: 1px 1px #FFFFFF;">
        <p>
            <?php printf(esc_html__( 'The usage instruction and video tutorial is available on the PayPal Donations plugin %1$sdocumentation page%2$s.', 'paypal-donations' ),'<a href="https://www.tipsandtricks-hq.com/paypal-donations-widgets-plugin" target="_blank">','</a>'); ?>
        </p>
        <p>
            <?php printf(esc_html__( 'If you want to accept donations and payments using PayPal\'s fast Checkout API, try our free %1$sWP Express Checkout%2$s plugin.', 'paypal-donations' ),'<a href="https://wordpress.org/plugins/wp-express-checkout/" target="_blank">','</a>'); ?>
        </p>
        <p>
            <?php printf(esc_html__( 'If you need a feature rich plugin for accepting PayPal donations and payments then check out our %1$sWP eStore Plugin%2$s (it comes with premium support). You can accept subscription/recurring payments with it also.', 'paypal-donations' ),'<a target="_blank" href="https://www.tipsandtricks-hq.com/wordpress-estore-plugin-complete-solution-to-sell-digital-products-from-your-wordpress-blog-securely-1059">','</a>'); ?>
        </p>
    </div>

    <h2 class="nav-tab-wrapper">
        <div id="paypal-donations-tabs">
            <a id="paypal-donations-tab_1" class="nav-tab nav-tab-active"><?php _e('General', 'paypal-donations'); ?></a>
            <a id="paypal-donations-tab_2" class="nav-tab"><?php _e('Advanced', 'paypal-donations'); ?></a>
        </div>
    </h2>

    <form method="post" action="options.php">
        <?php settings_fields($optionDBKey); ?>
        <div id="paypal-donations-tabs-content">
            <div id="paypal-donations-tab-content-1">
                <?php do_settings_sections($pageSlug); ?>
            </div>
        </div>
        <?php submit_button(); ?>
    </form>
