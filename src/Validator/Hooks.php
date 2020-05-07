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

defined( 'ABSPATH' ) || exit;

if ( ! trait_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Hooks' ) ) {
	/**
	 * Trait Hooks
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic\Validator
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	trait Hooks {
		/**
		 * @return bool|int|void
		 */
		public function did_action() {
			$hook   = ( empty( $this->get_value( 'hook' ) ) ) ? $this->get_value() : $this->get_value( 'hook' );
			$count  = ( $this->get_value( 'count' ) ) ? $this->get_value( 'count' ) : true;
			$is_did = did_action( $hook );
			if ( ! empty( $is_did ) ) {
				return ( true === $this->_is_bool( $count, true ) ) ? true : $is_did;
			}
			return false;
		}

		/**
		 * @return bool|int|void
		 */
		public function has_action() {
			return has_action( $this->get_value() );
		}

		/**
		 * @return bool|int|void
		 */
		public function has_filter() {
			return has_filter( $this->get_value() );
		}
	}
}
