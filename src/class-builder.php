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

use Varunsridharan\WordPress\WP_Conditional_Logic;

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
	 *
	 * @method is_admin( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_ajax( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_cron( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_frontend( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_ajax_action( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_404( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_date( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_year( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_month( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_day( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_time( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_new_day( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_multi_author( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method comments_open( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_post_type_hierarchical( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_post_type_archive( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_author( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_network_admin( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_archive( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_search( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_attachment( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_front_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_home( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_single( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_single_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_singular_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_sticky( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_paged( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_page_template( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_category( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_tag( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method has_tag( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method is_tax( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method has_term( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method user_id( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method user_can( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method user_name( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method user_meta( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method user_logged_in( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method user_role( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method post_id( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method post_type( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method post_title( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method post_name( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method post_content( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method post_terms( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method screen_id( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method did_action( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method has_action( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method has_filter( $value = "", $compare_operator = "", $extra_argument = '' )
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
		 * Builder constructor.
		 *
		 * @param string $condition
		 */
		public function __construct( $condition = 'and' ) {
			if ( 'and' === strtolower( $condition ) ) {
				$this->condition = 'and';
			} elseif ( 'or' === strtolower( $condition ) ) {
				$this->condition = 'or';
			}
		}

		/**
		 * Runs This Rule.
		 *
		 * @return bool
		 */
		public function run() {
			return WP_Conditional_Logic::run( $this->jsonSerialize() );
		}

		/**
		 * @param $name
		 * @param $arguments
		 *
		 * @return mixed
		 */
		public function __call( $name, $arguments ) {
			$arg = array_merge( array( $name ), $arguments );
			return call_user_func_array( array( &$this, 'rule' ), $arg );
		}

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
		 * @param bool   $value
		 * @param string $compare
		 * @param array  $arguments Additional Arguments.
		 *
		 * @return $this
		 */
		public function rule( $rule, $value = true, $compare = '=', $arguments = array() ) {
			$this->rules[] = array(
				'id'              => $rule,
				'field'           => $rule,
				'value'           => $value,
				'operator'        => $compare,
				'extra_arguments' => $arguments,
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
