<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Perfect Money gateway settings.
 */
return array(
	'enabled' => array(
		'title'   => __( 'Enable/Disable', 'woocommerce' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable Perfect Money payment method', 'woocommerce' ),
		'default' => 'yes'
	),
	'title' => array(
		'title'       => __( 'Title', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
		'default'     => __( 'Perfect Money', 'woocommerce' ),
		'desc_tip'    => true,
	),
	'payee_account' => array(
		'title'       => __( 'Payee Account', 'woocommerce' ),
		'type'        => 'text',
		'desc_tip'    => true,
	),
	'debug' => array(
		'title'       => __( 'Debug Log', 'woocommerce' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable logging', 'woocommerce' ),
		'default'     => 'no',
		'description' => sprintf( __( 'Log PM events, such as payment confirmations, inside <code>%s</code>', 'woocommerce' ), wc_get_log_file_path( 'pm' ) )
	),
	'alternate_passphrase' => array(
		'title'       => __( 'Alternate PassPhrase', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'Alternate PassPhrase can be found and set under Settings section of your PM account.', 'woocommerce' ),
		'default'     => '',
		'desc_tip'    => true,
	),
);
