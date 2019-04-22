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

require_once __DIR__ . '/validator/trait-users.php';
require_once __DIR__ . '/validator/trait-request.php';
require_once __DIR__ . '/validator/trait-hooks.php';
require_once __DIR__ . '/validator/trait-admin.php';
require_once __DIR__ . '/class-compare.php';

use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Requests;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Admin;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Users;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Post;
use Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Hooks;

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

	/**
	 * @var null
	 * @access
	 */
	private $system_rule = null;

	/**
	 * @var null
	 * @access
	 */
	private $user_value = null;

	/**
	 * @var string|null
	 * @access
	 */
	private $compare = null;

	/**
	 * Validators constructor.
	 *
	 * @param null   $system_rule
	 * @param null   $user_value
	 * @param string $compare
	 */
	public function __construct( $system_rule = null, $user_value = null, $compare = '=' ) {
		$this->system_rule = $system_rule;
		$this->user_value  = $user_value;
		$this->compare     = $compare;
	}

	/**
	 * @param bool $key
	 *
	 * @return mixed
	 */
	public function get_value( $key = false ) {
		if ( ( is_array( $this->user_value ) || ! is_array( $this->user_value ) ) && false === $key ) {
			return $this->user_value;
		}

		if ( 'value' === $key ) {
			return ( is_array( $this->user_value ) && isset( $this->user_value[ $key ] ) ) ? $this->user_value[ $key ] : $this->user_value;
		}

		if ( is_array( $this->user_value ) && isset( $this->user_value[ $key ] ) ) {
			return $this->user_value[ $key ];
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
		if ( method_exists( __CLASS__, $this->system_rule ) ) {
			$system_val = $this->{$this->system_rule}();
		} elseif ( has_filter( 'wp_conditional_logic_' . $this->system_rule ) ) {
			$system_val = apply_filters( 'wp_conditional_logic_' . $this->system_rule, false, $this->system_rule, $this->user_value, $this->compare );
		}
		return $this->compare_return( $this->compare, $system_val, $this->user_value );
	}
}
