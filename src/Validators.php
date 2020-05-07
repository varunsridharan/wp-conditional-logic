<?php
/**
 * Simple WordPress Library To Evaluate / Handle Conditional Logic.
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

defined( 'ABSPATH' ) || exit;

use Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Rule;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Requests;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Admin;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Theme;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Users;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Post;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Hooks;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Validators' ) ) {
	/**
	 * Class Validators
	 *
	 * @package Varunsridharan\WordPress
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Validators extends Compare {
		use Requests;
		use Users;
		use Post;
		use Admin;
		use Hooks;
		use Theme;

		/**
		 * Stores Rule's Instance.
		 *
		 * @var \Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Rule
		 * @access
		 */
		protected $rule = null;

		/**
		 * Validators constructor.
		 *
		 * @param \Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Rule $instance
		 */
		public function __construct( Rule $instance ) {
			$this->rule = $instance;
		}

		/**
		 * @param bool $key
		 *
		 * @return mixed
		 */
		public function get_value( $key = false ) {
			if ( ( is_array( $this->rule->value() ) || ! is_array( $this->rule->value() ) ) && false === $key ) {
				return $this->rule->value();
			}

			if ( 'value' === $key ) {
				return ( is_array( $this->rule->value() ) && isset( $this->rule->value()[ $key ] ) ) ? $this->rule->value()[ $key ] : $this->rule->value();
			}

			if ( is_array( $this->rule->value() ) && isset( $this->rule->value()[ $key ] ) ) {
				return $this->rule->value()[ $key ];
			}
			return false;
		}

		/**
		 * Returns A Metakey.
		 *
		 * @return bool|mixed
		 */
		public function get_meta_key() {
			if ( false !== $this->get_value( 'meta_key' ) ) {
				return $this->get_value( 'meta_key' );
			}

			if ( false !== $this->get_value( 'key' ) ) {
				return $this->get_value( 'key' );
			}
			if ( false !== $this->get_value( 'metakey' ) ) {
				return $this->get_value( 'metakey' );
			}
			return false;
		}

		/**
		 * Checks if given value is a bool.
		 *
		 * @param      $value
		 * @param bool $is_true
		 *
		 * @return bool
		 */
		public function _is_bool( $value, $is_true = true ) {
			if ( true === $is_true && ( true === $value || 'true' === $value ) ) {
				return true;
			} elseif ( false === $is_true && ( false === $value || 'false' === $value ) ) {
				return true;
			}
			return false;
		}

		/**
		 * Runs Single Rule.
		 *
		 * @return bool|mixed|void
		 */
		public function run() {
			$sys_rule   = $this->rule->id();
			$system_val = null;

			if ( method_exists( __CLASS__, $sys_rule ) ) {
				$system_val = $this->{$sys_rule}();
			} elseif ( function_exists( $sys_rule ) ) {
				$system_val = call_user_func( $sys_rule );
			} elseif ( has_filter( 'wp_conditional_logic_' . $sys_rule ) ) {
				$system_val = apply_filters( 'wp_conditional_logic_' . $sys_rule, false, $sys_rule, $this->rule->value(), $this->rule->operator() );
			}
			return $this->compare_return( $this->rule->operator(), $system_val, $this->rule->value() );
		}
	}
}
