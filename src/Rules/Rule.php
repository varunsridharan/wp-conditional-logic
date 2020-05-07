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

use Varunsridharan\WordPress\WP_Conditional_Logic\Validators;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Rules\Rule' ) ) {
	/**
	 * Class WP_Conditional_Logic
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Rule {
		/**
		 * @var null
		 * @access
		 */
		private $id;

		/**
		 * @var null
		 * @access
		 */
		private $field;

		/**
		 * @var null
		 * @access
		 */
		private $type;

		/**
		 * @var null
		 * @access
		 */
		private $input;

		/**
		 * @var null
		 * @access
		 */
		private $operator;

		/**
		 * @var null
		 * @access
		 */
		private $value;

		/**
		 * Stores Additonal Arguments.
		 *
		 * @var null
		 * @access
		 */
		private $arguments;

		/**
		 * Rule constructor.
		 *
		 * @param array $rule
		 */
		public function __construct( $rule = array() ) {
			$this->id        = ( isset( $rule['id'] ) ) ? $rule['id'] : false;
			$this->field     = ( isset( $rule['field'] ) ) ? $rule['field'] : false;
			$this->type      = ( isset( $rule['type'] ) ) ? $rule['type'] : false;
			$this->operator  = ( isset( $rule['operator'] ) ) ? $rule['operator'] : false;
			$this->input     = ( isset( $rule['input'] ) ) ? $rule['input'] : false;
			$this->value     = ( isset( $rule['value'] ) ) ? $rule['value'] : false;
			$this->arguments = ( isset( $rule['extra_arguments'] ) ) ? $rule['extra_arguments'] : false;
		}

		/**
		 * @return bool|mixed|void
		 */
		public function run() {
			$validator = new Validators( $this );
			return $validator->run();
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function id() {
			return $this->id;
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function value() {
			return $this->value;
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function operator() {
			return $this->operator;
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function type() {
			return $this->type;
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function field() {
			return $this->field;
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function input() {
			return $this->input;
		}

		/**
		 * Custom Getter Method.
		 *
		 * @return bool|mixed|null
		 */
		public function arguments() {
			return $this->arguments;
		}
	}
}
