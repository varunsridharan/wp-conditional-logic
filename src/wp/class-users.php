<?php

namespace Varunsridharan\WordPress\WP_Conditional_Logic;
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'Varunsridharan\WordPress\WP_Conditional_Logic\Users' ) ) {
	/**
	 * Class Users
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Users extends Compare_Helper {
		/**
		 * Returns Current User ID.
		 *
		 * @param array $condition
		 *
		 * @return int
		 */
		public function user_id( $condition = array() ) {
			return $this->compare_return( $condition, get_current_user_id() );
		}

		/**
		 * Checks if current user is possible to do certain actions.
		 *
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function user_can( $condition = array() ) {
			$sys_val = current_user_can( $condition['value'], $this->get_extra_arg( $condition ) );
			$sys_val = ( true === $sys_val ) ? $condition['value'] : false;
			return $this->compare_return( $condition, $sys_val );
		}

		/**
		 * Handles User Meta.
		 *
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function user_meta( $condition = array() ) {
			$meta = get_user_meta( get_current_user_id(), $this->get_extra_arg( $condition ), true );
			return $this->compare_return( $condition, $meta );
		}

		/**
		 * is user logged in
		 *
		 * @uses \is_user_logged_in()
		 *
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function user_logged_in( $condition = array() ) {
			return $this->compare_return( $condition, is_user_logged_in() );
		}
	}
}
