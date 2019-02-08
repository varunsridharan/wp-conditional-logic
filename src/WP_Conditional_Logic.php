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

namespace Varunsridharan\WordPress;

use Varunsridharan\WordPress\WP_Conditional_Logic\Admin;

if ( ! class_exists( 'WP_Conditional_Logic' ) ) {
	require_once __DIR__ . '/class-compare-helper.php';
	require_once __DIR__ . '/wp/class-users.php';
	require_once __DIR__ . '/wp/class-common-is-functions.php';
	require_once __DIR__ . '/wp/class-post.php';
	require_once __DIR__ . '/wp/class-hooks.php';
	require_once __DIR__ . '/wp/class-admin.php';

	/**
	 * Class WP_Conditional_Logic
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class WP_Conditional_Logic extends Admin {
		/**
		 * Stores List of Conditions.
		 *
		 * @var null
		 * @access
		 */
		private $condition = null;

		/**
		 * WP_Conditional_Logic constructor.
		 *
		 * @param array $conditions
		 *
		 * @example
		 * array(
		 *    array(
		 *        // Below 2 Conditions are With AND.
		 *        array( 'post_type', '=', 'product' ),
		 *        array( 'user_id', '=', '3' ),
		 *        // Below Is A OR Condition (Any of the 1 condition should be successful
		 *        array(
		 *            array( 'user_can', '=', 'admin_rights' ),
		 *            array( 'user_meta', '=', 'true', '_meta_key' ),
		 *        ),
		 *    ),
		 *    // OR Condition
		 *    array(
		 *        // Below 2 Conditions are With AND.
		 *        array( 'post_type', '=', 'product' ),
		 *        array( 'user_id', '=', '3' ),
		 *        // Below Is A OR Condition (Any of the 1 condition should be successful
		 *        array(
		 *            array( 'user_can', '=', 'admin_rights' ),
		 *            array( 'post_title', 'has', 'Wow' ),
		 *        ),
		 *    ),
		 * );
		 */
		public function __construct( $conditions = array() ) {
			$this->condition = $conditions;
		}

		/**
		 * Returns A New Instance.
		 *
		 * @param array $conditions
		 *
		 * @return \Varunsridharan\WordPress\WP_Conditional_Logic
		 */
		public static function init( $conditions = array() ) {
			return new self( $conditions );
		}

		/**
		 * Runs An Instance.
		 *
		 * @return bool|mixed
		 */
		public function run() {
			if ( isset( $this->condition[0] ) && is_string( $this->condition[0] ) ) {
				return $this->eval_single( $this->condition );
			} elseif ( isset( $this->condition[0] ) && is_array( $this->condition[0] ) ) {
				if ( is_array( $this->condition[0][0] ) ) {
					foreach ( $this->condition as $conditions ) {
						if ( is_array( $conditions ) && ! empty( $conditions ) ) {
							if ( true === $this->eval_group( $conditions ) ) {
								return true;
							}
						}
					}
				} else {
					return $this->eval_group( $this->condition );
				}
			}
			return false;
		}

		/**
		 * Returns true if any 1 condition returns true
		 *
		 * @param $conditions
		 *
		 * @return bool
		 */
		public function eval_group_or( $conditions ) {
			if ( is_array( $conditions ) && ! empty( $conditions ) ) {
				foreach ( $conditions as $condition ) {
					if ( is_array( $condition ) ) {
						if ( true === $this->eval_single( $condition ) ) {
							return true;
						}
					}
				}
			}
			return false;
		}

		/**
		 * @param $conditions
		 *
		 * @return bool
		 */
		public function eval_group( $conditions ) {
			if ( is_array( $conditions ) && ! empty( $conditions ) ) {
				foreach ( $conditions as $condition ) {
					if ( is_array( $condition ) ) {
						if ( is_array( $condition[0] ) ) {
							if ( false === $this->eval_group_or( $condition ) ) {
								return false;
							}
						} else {
							if ( false === $this->eval_single( $condition ) ) {
								return false;
							}
						}
					}
				}
			}
			return true;
		}

		/**
		 * Parses & Validates Single Condition.
		 *
		 * @param array $conditon
		 *
		 * @example
		 *  array( 'post_type', '=', 'product' );
		 *  or
		 *  array( 'user_id', '=', '3' );
		 *
		 * @return bool|mixed
		 */
		public function eval_single( $conditon ) {
			if ( count( $conditon ) === 1 ) {
				$conditon[1] = '==';
				$conditon[2] = true;
			} elseif ( count( $conditon ) === 2 ) {
				$conditon = array( $conditon[0], '=', $conditon[1] );
			} elseif ( count( $conditon ) === 3 ) {
				if ( false === self::valid_compare( $conditon[1] ) ) {
					$ex_val      = $conditon[1];
					$conditon[1] = '=';
					$conditon[3] = $conditon[2];
					$conditon[2] = $ex_val;
				}
			}

			$extra_condition      = $conditon;
			$conditon['logic']    = $conditon[0];
			$conditon['operator'] = $conditon[1];
			$conditon['value']    = $conditon[2];
			unset( $conditon[0] );
			unset( $conditon[1] );
			unset( $conditon[2] );
			unset( $extra_condition[0] );
			unset( $extra_condition[1] );
			unset( $extra_condition[2] );
			$conditon['extra'] = $extra_condition;

			if ( method_exists( __CLASS__, $conditon['logic'] ) ) {
				return self::{$conditon['logic']}( $conditon );
			} elseif ( has_filter( 'wp_conditional_logic_' . $conditon['logic'] ) ) {
				return apply_filters( 'wp_conditional_logic_' . $conditon['logic'], false, $conditon['logic'] );
			}
			return false;
		}

	}
}


