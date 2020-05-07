<?php

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wp_conditional_logic' ) ) {
	/**
	 * Validates Given Rules Set and return true or false.
	 *
	 * @param array $rules
	 *
	 * @return bool
	 */
	function wp_conditional_logic( $rules = array() ) {
		return Varunsridharan\WordPress\WP_Conditional_Logic::run( $rules );
	}
}


if ( ! function_exists( 'wp_conditional_logic_builder' ) ) {
	/**
	 * Returns A New Builder Instance.
	 *
	 * @param string $condition
	 *
	 * @return \Varunsridharan\WordPress\WP_Conditional_Logic\Builder
	 */
	function wp_conditional_logic_builder( $condition = 'and' ) {
		return new Varunsridharan\WordPress\WP_Conditional_Logic\Builder( $condition );
	}
}
