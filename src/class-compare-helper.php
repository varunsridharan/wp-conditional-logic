<?php
/**
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @since 1.0
 * @link
 * @copyright 2019 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Compare_Helper' ) ) {
	/**
	 * Class Compare_Helper
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Compare_Helper {

		/**
		 * @param $condition
		 *
		 * @static
		 * @return bool
		 */
		public static function get_extra_arg( $condition ) {
			return ( isset( $condition['extra'] ) ) ? $condition['extra'] : null;
		}

		/**
		 * Checks if compare function exists and if it dose then return bool based on it.
		 *
		 * @hook wp_conditional_logic_compare_{$method}
		 *
		 * @param      $compare
		 * @param null $sys_value
		 * @param null $user_value
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function compare_return( $compare, $sys_value = null, $user_value = null ) {
			if ( is_array( $compare ) ) {
				$user_value = $compare['value'];
				$compare    = $compare['operator'];
			}

			$compare = self::get_compare_function( $compare );
			if ( method_exists( __CLASS__, $compare ) ) {
				return self::{$compare}( $sys_value, $user_value );
			} elseif ( has_filter( 'wp_conditional_logic_compare_' . $compare ) ) {
				return apply_filters( 'wp_conditional_logic_compare_' . $compare, false, $sys_value, $user_value );
			}
			return false;
		}

		/**
		 * Returns Proper PHP function name based on the symbol.
		 *
		 * @param string $compare_logic
		 *
		 * @static
		 * @return bool|string
		 */
		public static function get_compare_function( $compare_logic ) {
			switch ( strtolower( $compare_logic ) ) {
				case '==':
				case '=':
				case '===':
					return ( '===' === $compare_logic ) ? 'is_equals_strict' : 'is_equals';
					break;

				case '!=':
				case '!==':
				case '!':
					return ( '!==' === $compare_logic ) ? 'is_not_equals_strict' : 'is_not_equals';
					break;

				case 'has':
				case 'contains':
					return 'is_string_contains';
					break;
			}
			return $compare_logic;
		}

		/**
		 * Validates if Given Compare is valid.
		 *
		 * @param $compare
		 *
		 * @static
		 * @return bool
		 */
		public static function valid_compare( $compare ) {
			$compare = self::get_compare_function( $compare );
			if ( ! method_exists( __CLASS__, $compare ) ) {
				if ( ! has_filter( 'wp_conditional_logic_compare_' . $compare ) ) {
					return false;
				}
			}
			return true;
		}

		/**
		 * Checks if Given Value are equal.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @static
		 * @return bool
		 */
		public static function is_equals( $system_value, $user_value ) {
			return ( $system_value == $user_value );
		}

		/**
		 * Checks if Given Value are equal strict.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @static
		 * @return bool
		 */
		public static function is_equals_strict( $system_value, $user_value ) {
			return ( $system_value === $user_value );
		}

		/**
		 * Checks if Given Value are not equal.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @static
		 * @return bool
		 */
		public static function is_not_equals( $system_value, $user_value ) {
			return ( $system_value != $user_value );
		}

		/**
		 * Checks if Given Value are not equal strict.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @static
		 * @return bool
		 */
		public static function is_not_equals_strict( $system_value, $user_value ) {
			return ( $system_value !== $user_value );
		}

		/**
		 * Checks if given string has a given word / char.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @static
		 * @return bool
		 */
		public static function is_string_contains( $system_value, $user_value ) {
			return ( false !== strpos( $system_value, $user_value ) );
		}
	}
}
