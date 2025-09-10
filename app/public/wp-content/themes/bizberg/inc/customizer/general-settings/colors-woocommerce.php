<?php

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'woocommerce_colors_settings',
    'section'     => 'theme_colors',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'WooCommerce Colors', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'simple-color',
	'settings'    => 'woocommerce_secondary_color',
	'label'       => esc_html__( 'Secondary Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_woocommerce_secondary_color', '#14181b' ),
	'transport'   => 'auto',
	'output' => apply_filters( 'bizberg_woocommerce_secondary_color_css', 
		array(
			array(
				'element'  => '.bizberg_woocommerce_shop .woocommerce-breadcrumb, .bizberg_woocommerce_shop ul.products li.product, .bizberg_woocommerce_shop ul.products li.product:hover .woocommerce_shop_loop_content, .bizberg_woocommerce_shop .woocommerce_shop_loop_content, .bizberg_woocommerce_shop .woocommerce-ordering select option, .bizberg_woocommerce_shop .bizberg-shop-quantity button.plus, .bizberg_woocommerce_shop .bizberg-shop-quantity button.minus, .bizberg_woocommerce_shop .quantity .qty, ins, mark, .bizberg_woocommerce_shop div.product form.variations_form.cart .variations .value select, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table tbody td.product-remove a, .bizberg_woocommerce_shop.woocommerce-wishlist table td.product-remove a, input[type=text], input[type=email], input[type=password], input[type=date], input[type=url], select,.bizberg_woocommerce_shop.woocommerce-checkout input[type=text], .bizberg_woocommerce_shop.woocommerce-checkout textarea, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table tbody tr:nth-child(even), .bizberg_woocommerce_shop.woocommerce-checkout table.shop_table tbody tr:nth-child(even), .bizberg_woocommerce_shop.woocommerce-checkout table.shop_table tbody tr:nth-child(even), .bizberg_woocommerce_shop.woocommerce-checkout table.shop_table tfoot tr:nth-child(even), .bizberg_woocommerce_shop.woocommerce-wishlist table.shop_table tbody tr:nth-child(even), .bizberg_woocommerce_shop.woocommerce-account table.shop_table tbody tr:nth-child(even), .bizberg_woocommerce_shop.woocommerce-account table.shop_table tfoot tr:nth-child(even), .bizberg_dark_mode .select2-dropdown, .bizberg_woocommerce_shop.woocommerce-checkout #payment div.payment_box, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-navigation,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-content .form-row input.input-text',
				'property' => 'background',
			),
			array(
				'element'  => '.bizberg_woocommerce_shop .bizberg-shop-quantity button.plus, .bizberg_woocommerce_shop .bizberg-shop-quantity button.minus, .bizberg_woocommerce_shop .quantity .qty, .bizberg_woocommerce_shop.woocommerce-cart .woocommerce .quantity .qty, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table tbody td.product-remove a, .bizberg_woocommerce_shop.woocommerce-wishlist table td.product-remove a, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text, .bizberg_woocommerce_shop.woocommerce-checkout input[type=text], .bizberg_woocommerce_shop.woocommerce-checkout textarea, .bizberg_woocommerce_shop.woocommerce-checkout .select2-container--default .select2-selection--single, .bizberg_woocommerce_shop.woocommerce-checkout input[type=text], .bizberg_woocommerce_shop.woocommerce-checkout input[type=email], .bizberg_woocommerce_shop.woocommerce-checkout input[type=password], .bizberg_woocommerce_shop.woocommerce-checkout input[type=tel], .bizberg_woocommerce_shop.woocommerce-checkout input[type=date], .bizberg_woocommerce_shop.woocommerce-checkout input[type=url], .bizberg_woocommerce_shop.woocommerce-checkout textarea, .bizberg_woocommerce_shop.woocommerce-checkout .select2-container--default .select2-selection--single',
				'property' => 'border-color',
			),
			array(
				'element'  => '.bizberg_woocommerce_shop.woocommerce-checkout #payment div.payment_box::before',
				'property' => 'border-bottom-color',
			),
			array(
				'element'       => '.bizberg_woocommerce_shop .bizberg-shop-quantity button:hover, .bizberg_woocommerce_shop div.product form.cart .button, .bizberg_woocommerce_shop #review_form #respond .form-submit input, .bizberg_woocommerce_shop .bizberg-shop-quantity button:hover, .bizberg_woocommerce_shop div.product form.cart .button, .bizberg_woocommerce_shop #review_form #respond .form-submit input, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table td .button, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table td .button:hover, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page a.checkout-button, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page a.checkout-button:hover, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page p.return-to-shop a, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page p.return-to-shop a:hover, .bizberg_woocommerce_shop.woocommerce-checkout #payment #place_order, .bizberg_woocommerce_shop.woocommerce-checkout #payment #place_order:hover, .bizberg_woocommerce_shop.woocommerce-checkout form.checkout_coupon.woocommerce-form-coupon button, .bizberg_woocommerce_shop.woocommerce-checkout form.checkout_coupon.woocommerce-form-coupon button:hover, .bizberg_woocommerce_shop.woocommerce-checkout form.woocommerce-form-login button, .bizberg_woocommerce_shop.woocommerce-checkout form.woocommerce-form-login button:hover, .bizberg_woocommerce_shop.woocommerce-lost-password button.woocommerce-Button.button, .bizberg_woocommerce_shop.woocommerce-lost-password button.woocommerce-Button.button:hover, .bizberg_woocommerce_shop.woocommerce-wishlist table td.product-add-to-cart a.button, .bizberg_woocommerce_shop.woocommerce-wishlist table td.product-add-to-cart a.button:hover, .bizberg_woocommerce_shop.woocommerce-wishlist .wishlist_table .product-name a.yith-wcqv-button:hover, .bizberg_woocommerce_shop.woocommerce-wishlist .wishlist_table .product-add-to-cart a, .bizberg_woocommerce_shop .woocommerce-form-login .woocommerce-form-login__submit, .bizberg_woocommerce_shop .woocommerce-form-login .woocommerce-form-login__submit:hover, .bizberg_woocommerce_shop .woocommerce-form-register .woocommerce-form-register__submit, .bizberg_woocommerce_shop .woocommerce-form-register .woocommerce-form-register__submit:hover, .bizberg_woocommerce_shop.woocommerce-wishlist .wishlist_table .product-add-to-cart a:hover, .bizberg_woocommerce_shop.woocommerce-account table.my_account_orders .button, .bizberg_woocommerce_shop.woocommerce-account table.my_account_orders .button:hover, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-pagination a, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-pagination a:hover, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-info a, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-info a:hover, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-content p button, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-content p button:hover, .bizberg_woocommerce_shop.woocommerce-account form.woocommerce-EditAccountForm p button, .bizberg_woocommerce_shop .bizberg_header_mini_cart_wrapper p.woocommerce-mini-cart__buttons.buttons a, .header_sidemenu_in .woocommerce_cart_sidebar>p.buttons a, .header_sidemenu .mhead p span, .header_sidemenu .mhead p:hover, .bizberg_woocommerce_shop.woocommerce-checkout input[type=text], .bizberg_woocommerce_shop.woocommerce-checkout input[type=email], .bizberg_woocommerce_shop.woocommerce-checkout input[type=password], .bizberg_woocommerce_shop.woocommerce-checkout input[type=tel], .bizberg_woocommerce_shop.woocommerce-checkout input[type=date], .bizberg_woocommerce_shop.woocommerce-checkout input[type=url], .bizberg_woocommerce_shop.woocommerce-checkout textarea, .bizberg_woocommerce_shop.woocommerce-checkout .select2-container--default .select2-selection--single',
				'property'      => 'background',
				'value_pattern' => '$ !important'
			)
		)
	)
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'theme_colors_settings',
    'section'     => 'theme_colors',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Theme Colors', 'bizberg' ) . '</div>',
) );