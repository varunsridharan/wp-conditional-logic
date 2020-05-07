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

namespace Varunsridharan\WordPress\WP_Conditional_Logic\Rules;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Group' ) ) {
	/**
	 * Class WP_Conditional_Logic
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Group {
		/**
		 * Stores Group Condition.
		 *
		 * @var null
		 * @access
		 */
		private $condition = null;

		/**
		 * Stores All Rules Instance.
		 *
		 * @var array
		 * @access
		 */
		private $rules = array();

		/**
		 * Stores Valid.
		 *
		 * @var bool
		 * @access
		 */
		private $is_valid = true;

		/**
		 * Group constructor.
		 *
		 * @param array $rule_group
		 */
		public function __construct( $rule_group = array() ) {
			$this->condition = ( isset( $rule_group['condition'] ) ) ? $rule_group['condition'] : 'and';
			$this->is_valid  = ( isset( $rule_group['valid'] ) ) ? $rule_group['valid'] : false;

			foreach ( $rule_group['rules'] as $rule ) {
				if ( isset( $rule['condition'] ) && isset( $rule['rules'] ) ) {
					$this->rules[] = new self( $rule );
				} else {
					$this->rules[] = new Rule( $rule );
				}
			}
		}

		/**
		 * @return bool
		 */
		public function run() {
			/* @var \Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Rule $rule */
			foreach ( $this->rules as $rule ) {
				$status = $rule->run();
				if ( $this->is_and() && false === $status ) {
					return false;
				}
				if ( $this->is_or() && true === $status ) {
					return true;
				}
			}
			return ( $this->is_or() ) ? false : true;
		}

		/**
		 * Returns Condition.
		 *
		 * @return bool
		 */
		public function condition() {
			return ( isset( $this->condition ) && ! empty( $this->condition ) ) ? $this->condition : false;
		}

		/**
		 * Checks if its AND Condition.
		 *
		 * @return bool
		 */
		public function is_and() {
			return ( 'and' === strtolower( $this->condition() ) );
		}

		/**
		 * Checks if its OR Condition.
		 *
		 * @return bool
		 */
		public function is_or() {
			return ( 'or' === strtolower( $this->condition() ) );
		}
	}
}
