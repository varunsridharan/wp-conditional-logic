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

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Builder' ) ) {
	/**
	 * Class Builder
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Builder implements \JsonSerializable, \ArrayAccess {
		/**
		 * @var string
		 * @access
		 */
		private $condition = 'and';

		/**
		 * @var array
		 * @access
		 */
		private $rules = array();

		/**
		 * @var bool
		 * @access
		 */
		private $valid = true;

		/**
		 * @return $this|\Varunsridharan\WordPress\WP_Conditional_Logic\Builder
		 */
		public function or() {
			if ( empty( $this->rules ) ) {
				$this->condition = 'or';
				return $this;
			} else {
				$instance = new self();
				$instance->or();
				$this->rules[] = $instance;
				return $instance;
			}
		}

		/**
		 * @return $this|\Varunsridharan\WordPress\WP_Conditional_Logic\Builder
		 */
		public function and() {
			if ( empty( $this->rules ) ) {
				$this->condition = 'and';
				return $this;
			} else {
				$instance = new self();
				$instance->and();
				$this->rules[] = $instance;
				return $instance;
			}
		}

		/**
		 * @return array|mixed
		 */
		public function jsonSerialize() {
			return array(
				'condition' => $this->condition,
				'rules'     => $this->rules,
				'valid'     => $this->valid,
			);
		}

		/**
		 * @param        $rule
		 * @param        $value
		 * @param string $compare
		 *
		 * @return $this
		 */
		public function rule( $rule, $value = true, $compare = '=' ) {
			$this->rules[] = array(
				'id'       => $rule,
				'field'    => $rule,
				'value'    => $value,
				'operator' => $compare,
			);
			return $this;
		}

		/**
		 * @param mixed $offset
		 *
		 * @return bool|mixed
		 */
		public function offsetGet( $offset ) {
			return ( isset( $this->{$offset} ) ) ? $this->{$offset} : false;
		}

		/**
		 * @param mixed $offset
		 * @param mixed $value
		 *
		 * @return bool|void
		 */
		public function offsetSet( $offset, $value ) {
			return false;
		}

		/**
		 * @param mixed $offset
		 *
		 * @return bool
		 */
		public function offsetExists( $offset ) {
			return ( isset( $this->{$offset} ) );
		}

		/**
		 * @param mixed $offset
		 *
		 * @return bool|void
		 */
		public function offsetUnset( $offset ) {
			return false;
		}
	}
}