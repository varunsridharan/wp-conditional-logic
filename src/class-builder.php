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
	 * @method is_admin() $builder->is_admin( $value = "", $compare_operator = "" )
	 * @method is_ajax() $builder->is_ajax( $value = "", $compare_operator = "" )
	 * @method is_cron() $builder->is_cron( $value = "", $compare_operator = "" )
	 * @method is_frontend() $builder->is_frontend( $value = "", $compare_operator = "" )
	 * @method is_ajax_action() $builder->is_ajax_action( $value = "", $compare_operator = "" )
	 * @method is_404() $builder->is_404( $value = "", $compare_operator = "" )
	 * @method is_date() $builder->is_date( $value = "", $compare_operator = "" )
	 * @method is_year() $builder->is_year( $value = "", $compare_operator = "" )
	 * @method is_month() $builder->is_month( $value = "", $compare_operator = "" )
	 * @method is_day() $builder->is_day( $value = "", $compare_operator = "" )
	 * @method is_time() $builder->is_time( $value = "", $compare_operator = "" )
	 * @method is_new_day() $builder->is_new_day( $value = "", $compare_operator = "" )
	 * @method is_multi_author() $builder->is_multi_author( $value = "", $compare_operator = "" )
	 * @method comments_open() $builder->comments_open( $value = "", $compare_operator = "" )
	 * @method is_post_type_hierarchical() $builder->is_post_type_hierarchical( $value = "", $compare_operator = "" )
	 * @method is_post_type_archive() $builder->is_post_type_archive( $value = "", $compare_operator = "" )
	 * @method is_author() $builder->is_author( $value = "", $compare_operator = "" )
	 * @method is_network_admin() $builder->is_network_admin( $value = "", $compare_operator = "" )
	 * @method is_archive() $builder->is_archive( $value = "", $compare_operator = "" )
	 * @method is_search() $builder->is_search( $value = "", $compare_operator = "" )
	 * @method is_attachment() $builder->is_attachment( $value = "", $compare_operator = "" )
	 * @method is_front_page() $builder->is_front_page( $value = "", $compare_operator = "" )
	 * @method is_home() $builder->is_home( $value = "", $compare_operator = "" )
	 * @method is_single() $builder->is_single( $value = "", $compare_operator = "" )
	 * @method is_single_page() $builder->is_single_page( $value = "", $compare_operator = "" )
	 * @method is_singular_page() $builder->is_singular_page( $value = "", $compare_operator = "" )
	 * @method is_sticky() $builder->is_sticky( $value = "", $compare_operator = "" )
	 * @method is_page() $builder->is_page( $value = "", $compare_operator = "" )
	 * @method is_paged() $builder->is_paged( $value = "", $compare_operator = "" )
	 * @method is_page_template() $builder->is_page_template( $value = "", $compare_operator = "" )
	 * @method is_category() $builder->is_category( $value = "", $compare_operator = "" )
	 * @method is_tag() $builder->is_tag( $value = "", $compare_operator = "" )
	 * @method has_tag() $builder->has_tag( $value = "", $compare_operator = "" )
	 * @method is_tax() $builder->is_tax( $value = "", $compare_operator = "" )
	 * @method has_term() $builder->has_term( $value = "", $compare_operator = "" )
	 * @method user_id() $builder->user_id( $value = "", $compare_operator = "" )
	 * @method user_can() $builder->user_can( $value = "", $compare_operator = "" )
	 * @method user_name() $builder->user_name( $value = "", $compare_operator = "" )
	 * @method user_meta() $builder->user_meta( $value = "", $compare_operator = "" )
	 * @method user_logged_in() $builder->user_logged_in( $value = "", $compare_operator = "" )
	 * @method user_role() $builder->user_role( $value = "", $compare_operator = "" )
	 * @method post_id() $builder->post_id( $value = "", $compare_operator = "" )
	 * @method post_type() $builder->post_type( $value = "", $compare_operator = "" )
	 * @method post_title() $builder->post_title( $value = "", $compare_operator = "" )
	 * @method post_name() $builder->post_name( $value = "", $compare_operator = "" )
	 * @method post_content() $builder->post_content( $value = "", $compare_operator = "" )
	 * @method post_terms() $builder->post_terms( $value = "", $compare_operator = "" )
	 * @method screen_id() $builder->screen_id( $value = "", $compare_operator = "" )
	 * @method did_action() $builder->did_action( $value = "", $compare_operator = "" )
	 * @method has_action() $builder->has_action( $value = "", $compare_operator = "" )
	 * @method has_filter() $builder->has_filter( $value = "", $compare_operator = "" )
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