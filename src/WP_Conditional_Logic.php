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

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

use Varunsridharan\WordPress\WP_Conditional_Logic\Builder;
use Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Group;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic' ) ) {
	require_once __DIR__ . '/class-builder.php';
	require_once __DIR__ . '/class-validators.php';
	require_once __DIR__ . '/rules/class-group.php';
	require_once __DIR__ . '/rules/class-rule.php';

	/**
	 * Class WP_Conditional_Logic
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class WP_Conditional_Logic {
		/**
		 * @var array
		 * @access
		 */
		protected $rules = array();

		/**
		 * @var array
		 * @access
		 */
		protected $current = array();

		/**
		 * Returns A New Builder Instance.
		 *
		 * @static
		 * @return \Varunsridharan\WordPress\WP_Conditional_Logic\Builder
		 */
		public static function builder() {
			return new Builder();
		}

		public static function run( $rules = array() ) {
			if ( isset( $rules['valid'] ) && true === $rules['valid'] ) {
				if ( isset( $rules['condition'] ) && isset( $rules['rules'] ) ) {
					$rules = new Group( $rules );
					var_dump( $rules->run() );
				}
			}
			return false;
		}
	}
}