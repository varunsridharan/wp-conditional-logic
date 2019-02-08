<?php

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'Varunsridharan\WordPress\WP_Conditional_Logic\Admin' ) ) {
	/**
	 * Class Admin
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Admin extends Post {
		/**
		 * Returns Current Screen Object.
		 *
		 * @static
		 * @return bool|\WP_Screen
		 */
		private static function get_screen_object() {
			if ( is_admin() && ( did_action( 'current_screen' ) || doing_action( 'current_screen' ) ) ) {
				$screen = get_current_screen();
				if ( $screen ) {
					return $screen;
				}
			}
			return false;
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function screen_id( $condition = array() ) {
			if ( self::get_screen_object() ) {
				$screen = self::get_screen_object();
				if ( isset( $screen->id ) ) {
					return self::compare_return( $condition, $screen->id );
				}
			}
			return false;
		}
	}
}
