<?php
/**
 * Plugin Name: Color Hexes for Variation Swatches
 * Plugin URI: https://orangedotdevelopment.com/software/wordpress/plugins/color-hexes-for-variation-swatches/
 * Description: Displays the color hex code after the color name in the order meta when using the Variation Swatches for WooCommerce plugin.
 * Version: 1.0.0
 * Author: Jarret
 * Author URI: https://orangedotdevelopment.com
 * Text Domain: odd-color-hexes
 * Requires Plugins: woocommerce, woo-variation-swatches
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'woocommerce_order_item_display_meta_value', 'odd_color_hexes', 10, 3 );

function odd_color_hexes( $meta_value, $meta, $item ) {
    $term_data = get_term_by( 'name', $meta->value, $meta->key );

    if ( $term_data ) {
        $term_meta = get_term_meta( $term_data->term_id );
    }

    if ( isset( $term_meta['product_attribute_color'] ) && is_admin() ) {
        $meta_value .= esc_html( ' - ' . $term_meta['product_attribute_color'][0] );
    }

    return $meta_value;
}
