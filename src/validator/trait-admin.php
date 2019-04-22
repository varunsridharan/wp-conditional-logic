<?php
/**
 * Simple WordPress Library To Evaluate / Handle Conditional Logic.
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @since 1.0
 * @link
 * @copyright 2019 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace Varunsridharan\WordPress\WP_Conditional_Logic\Validator;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Trait Admin
 *
 * @package Varunsridharan\WordPress\WP_Conditional_Logic\Validator
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since 1.0
 */
trait Admin {
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
	 * @return bool|mixed
	 */
	public function screen_id() {
		if ( $this->get_screen_object() ) {
			$screen = $this->get_screen_object();
			return ( isset( $screen->id ) ) ? $screen->id : false;
		}
		return false;
	}
}
