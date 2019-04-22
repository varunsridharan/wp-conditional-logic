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
 * Trait Users
 *
 * @package Varunsridharan\WordPress\WP_Conditional_Logic\Validator
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since 1.0
 */
trait Users {
	/**
	 * @return mixed
	 */
	public function user_id() {
		return get_current_user_id();
	}

	/**
	 * @return mixed
	 */
	public function user_can() {
		$sys_val = current_user_can( $this->get_value() );
		$sys_val = ( true === $sys_val ) ? $this->get_value() : false;
		return $sys_val;
	}

	/**
	 * @return bool|string
	 */
	public function user_name() {
		$current_user = wp_get_current_user();
		return ( isset( $current_user->user_login ) ) ? $current_user->user_login : false;
	}

	/**
	 * @return bool|mixed
	 */
	public function user_meta() {
		$meta = get_user_meta( get_current_user_id(), $this->get_meta_key(), true );
		return ( ! empty( $meta ) ) ? $meta : false;
	}

	/**
	 * @return mixed
	 */
	public function user_logged_in() {
		return is_user_logged_in();
	}

	/**
	 * @return array|bool
	 */
	public function user_role() {
		$current_user = wp_get_current_user();
		$user_roles   = $current_user->roles;
		$user_role    = array_shift( $user_roles );
		return ( ! empty( $user_role ) ) ? $user_role : false;
	}
}
