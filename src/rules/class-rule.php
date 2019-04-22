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

use Varunsridharan\WordPress\WP_Conditional_Logic\Validators;

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
	private $id = null;

	/**
	 * @var null
	 * @access
	 */
	private $field = null;

	/**
	 * @var null
	 * @access
	 */
	private $type = null;

	/**
	 * @var null
	 * @access
	 */
	private $input = null;

	/**
	 * @var null
	 * @access
	 */
	private $operator = null;

	/**
	 * @var null
	 * @access
	 */
	private $value = null;

	/**
	 * Rule constructor.
	 *
	 * @param array $rule
	 */
	public function __construct( $rule = array() ) {
		$this->id       = ( isset( $rule['id'] ) ) ? $rule['id'] : false;
		$this->field    = ( isset( $rule['field'] ) ) ? $rule['field'] : false;
		$this->type     = ( isset( $rule['type'] ) ) ? $rule['type'] : false;
		$this->operator = ( isset( $rule['operator'] ) ) ? $rule['operator'] : false;
		$this->input    = ( isset( $rule['input'] ) ) ? $rule['input'] : false;
		$this->value    = ( isset( $rule['value'] ) ) ? $rule['value'] : false;
	}

	/**
	 * @return bool|mixed|void
	 */
	public function run() {
		$validator = new Validators( $this->id, $this->value, $this->operator );
		return $validator->run();
	}
}
