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

use Varunsridharan\WordPress\WP_Conditional_Logic\Common_Is_Functions;
use Varunsridharan\WordPress\WP_Conditional_Logic\Post;

if ( ! class_exists( 'WP_Conditional_Logic' ) ) {
	require_once __DIR__ . '/class-compare-helper.php';
	require_once __DIR__ . '/wp/class-users.php';
	require_once __DIR__ . '/wp/class-common-is-functions.php';
	require_once __DIR__ . '/wp/class-post.php';

	/**
	 * Class WP_Conditional_Logic
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class WP_Conditional_Logic extends Post {
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
		}

		/**
		 * Returns true if any 1 condition returns true
		 *
		 * @param $conditions
		 *
		 * @static
		 * @return bool
		 */
		public static function eval_group_or( $conditions ) {
			if ( is_array( $conditions ) && ! empty( $conditions ) ) {
				foreach ( $conditions as $condition ) {
					if ( is_array( $condition ) ) {
						if ( true === self::eval_single( $condition ) ) {
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
		 * @static
		 * @return bool
		 */
		public static function eval_group( $conditions ) {
			if ( is_array( $conditions ) && ! empty( $conditions ) ) {
				foreach ( $conditions as $condition ) {
					if ( is_array( $condition ) ) {
						if ( is_array( $condition[0] ) ) {
							if ( false === self::eval_group_or( $condition ) ) {
								return false;
							}
						} else {
							if ( false === self::eval_single( $condition ) ) {
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
		 * array(
		 *  // Below 2 Conditions are With AND.
		 *  array( 'post_type', '=', 'product' ),
		 *  array( 'user_id', '=', '3' ),
		 *  // Below Is A OR Condition (Any of the 1 condition should be successful
		 *  array(
		 *      array( 'user_can', '=', 'admin_rights' ),
		 *      array( 'user_meta', '=', 'true', '_meta_key' ),
		 *  ),
		 * );
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function eval_single( $conditon ) {
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

			$conditon = array(
				'logic'    => $conditon[0],
				'operator' => $conditon[1],
				'value'    => $conditon[2],
				'extra'    => isset( $conditon[3] ) ? $conditon[3] : null,
			);

			if ( method_exists( __CLASS__, $conditon['logic'] ) ) {
				return self::{$conditon['logic']}( $conditon );
			} elseif ( has_filter( 'wp_conditional_logic_' . $conditon['logic'] ) ) {
				return apply_filters( 'wp_conditional_logic_' . $conditon['logic'], false, $conditon['logic'] );
			}
			return false;
		}

	}
}


