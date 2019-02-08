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
		 * @return bool|\WP_Screen
		 */
		private function get_screen_object() {
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
		 * @return bool|mixed
		 */
		public function screen_id( $condition = array() ) {
			if ( $this->get_screen_object() ) {
				$screen = $this->get_screen_object();
				if ( isset( $screen->id ) ) {
					return $this->compare_return( $condition, $screen->id );
				}
			}
			return false;
		}
	}
}
