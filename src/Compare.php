<?php
/**
 * Simple WordPress Library To Evaluate / Handle Conditional Logic.
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Compare' ) ) {
	/**
	 * Class Compare
	 *
	 * @package Varunsridharan\WordPress
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Compare {

		/**
		 * Checks if compare function exists and if it dose then return bool based on it.
		 *
		 * @hook wp_conditional_logic_compare_{$method}
		 *
		 * @param      $compare
		 * @param null $sys_value
		 * @param null $user_value
		 *
		 * @return bool|mixed
		 */
		public function compare_return( $compare, $sys_value = null, $user_value = null ) {
			if ( is_array( $compare ) ) {
				$user_value = $compare['value'];
				$compare    = $compare['operator'];
			}

			$compare = $this->get_compare_function( $compare );
			if ( method_exists( __CLASS__, $compare ) ) {
				return $this->{$compare}( $sys_value, $user_value );
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
		 * @return bool|string
		 */
		public function get_compare_function( $compare_logic ) {
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

				case 'in':
				case 'inor':
					return ( 'inor' === $compare_logic ) ? 'is_array_in_or' : 'is_array_in';
					break;
			}
			return $compare_logic;
		}

		/**
		 * Validates if Given Compare is valid.
		 *
		 * @param $compare
		 *
		 * @return bool
		 */
		public function valid_compare( $compare ) {
			$compare = $this->get_compare_function( $compare );
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
		 * @return bool
		 */
		public function is_equals( $system_value, $user_value ) {
			return ( $system_value == $user_value );
		}

		/**
		 * Checks if Given Value are equal strict.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @return bool
		 */
		public function is_equals_strict( $system_value, $user_value ) {
			return ( $system_value === $user_value );
		}

		/**
		 * Checks if Given Value are not equal.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @return bool
		 */
		public function is_not_equals( $system_value, $user_value ) {
			return ( $system_value != $user_value );
		}

		/**
		 * Checks if Given Value are not equal strict.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @return bool
		 */
		public function is_not_equals_strict( $system_value, $user_value ) {
			return ( $system_value !== $user_value );
		}

		/**
		 * Checks if given string has a given word / char.
		 *
		 * @param $system_value
		 * @param $user_value
		 *
		 * @return bool
		 */
		public function is_string_contains( $system_value, $user_value ) {
			return ( false !== strpos( $system_value, $user_value ) );
		}

		/**
		 * @param      $system_value
		 * @param      $user_value
		 * @param bool $is_or
		 *
		 * @return bool
		 */
		public function is_array_in( $system_value, $user_value, $is_or = false ) {
			$system_value = ( ! is_array( $system_value ) ) ? array( $system_value ) : $system_value;
			$user_value   = ( ! is_array( $user_value ) ) ? array( $user_value ) : $user_value;
			$return       = 0;
			foreach ( $user_value as $user_val ) {
				if ( isset( $system_value[ $user_val ] ) ) {
					$return++;
					if ( true === $is_or ) {
						return true;
					}
				} else {
					if ( in_array( $user_val, $system_value ) ) {
						$return++;
						if ( true === $is_or ) {
							return true;
						}
					}
				}
			}
			return ( 0 > $return );
		}

		/**
		 * @param $system_value
		 * @param $user_value
		 *
		 * @return bool
		 */
		public function is_array_in_or( $system_value, $user_value ) {
			return $this->is_array_in( $system_value, $user_value, true );
		}

		/**
		 * @param $function
		 * @param $args
		 *
		 * @return mixed
		 */
		public function call_func( $function, $args ) {
			return ( is_array( $function ) ) ? call_user_func_array( $function, $args ) : call_user_func( $function, $args );
		}
	}
}
