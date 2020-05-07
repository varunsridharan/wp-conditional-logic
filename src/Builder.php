<?php
/**
 * Simple WordPress Library To Evaluate / Handle Conditional Logic.
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

use Varunsridharan\WordPress\WP_Conditional_Logic;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Builder' ) ) {
	/**
	 * Class Builder
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 *
	 * @method $this is_admin( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_ajax( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_cron( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_frontend( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_ajax_action( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_404( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_date( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_year( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_month( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_day( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_time( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_new_day( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_multi_author( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this comments_open( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_post_type_hierarchical( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_post_type_archive( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_author( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_network_admin( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_archive( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_search( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_attachment( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_front_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_home( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_single( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_single_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_singular_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_sticky( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_page( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_paged( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_page_template( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_category( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_tag( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this has_tag( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this is_tax( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this has_term( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this user_id( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this user_can( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this user_name( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this user_meta( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this user_logged_in( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this user_role( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this post_id( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this post_type( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this post_title( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this post_name( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this post_content( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this post_terms( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this screen_id( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this did_action( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this has_action( $value = "", $compare_operator = "", $extra_argument = '' )
	 * @method $this has_filter( $value = "", $compare_operator = "", $extra_argument = '' )
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
