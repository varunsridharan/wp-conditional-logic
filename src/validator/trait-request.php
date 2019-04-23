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

namespace Varunsridharan\WordPress\WP_Conditional_Logic\Validator;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! trait_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Requests' ) ) {
	/**
	 * Trait Requests
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic\Validator
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	trait Requests {
		/**
		 * @return bool
		 */
		public function is_admin() {
			return is_admin();
		}

		/**
		 * @return bool
		 */
		public function is_ajax() {
			return ( defined( 'DOING_AJAX' ) && true === DOING_AJAX );
		}

		/**
		 * @return bool
		 */
		public function is_cron() {
			return ( defined( 'DOING_CRON' ) && true === DOING_CRON );
		}

		/**
		 * @return bool
		 */
		public function is_frontend() {
			$status = ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			return $status;
		}

		/**
		 * @return bool
		 */
		public function is_ajax_action() {
			if ( defined( 'DOING_AJAX' ) && true === DOING_AJAX ) {
				$action = ( isset( $_REQUEST['action'] ) && ! empty( $_REQUEST['action'] ) );
				return $action;
			}
			return false;
		}

		/**
		 * @return bool
		 */
		public function is_404() {
			return is_404();
		}

		/**
		 * @return bool
		 */
		public function is_date() {
			return is_date();
		}

		/**
		 * @return bool
		 */
		public function is_year() {
			return is_year();
		}

		/**
		 * @return bool
		 */
		public function is_month() {
			return is_month();
		}

		/**
		 * @return bool
		 */
		public function is_day() {
			return is_day();
		}

		/**
		 * @return bool
		 */
		public function is_time() {
			return is_time();
		}

		/**
		 * @return int
		 */
		public function is_new_day() {
			return is_new_day();
		}

		/**
		 * @return bool
		 */
		public function is_multi_author() {
			return is_multi_author();
		}

		/**
		 * @return bool
		 */
		public function comments_open() {
			return comments_open();
		}

		/**
		 * @return bool
		 */
		public function is_post_type_hierarchical() {
			return is_post_type_hierarchical( $this->get_value() );
		}

		/**
		 * @return bool
		 */
		public function is_post_type_archive() {
			return is_post_type_archive( $this->get_value() );
		}

		/**
		 * @return bool
		 */
		public function is_author() {
			return is_author( $this->get_value() );
		}

		/**
		 * @return bool
		 */
		public function is_network_admin() {
			return is_network_admin();
		}

		/**
		 * @return bool
		 */
		public function is_archive() {
			return is_archive();
		}

		/**
		 * @return bool
		 */
		public function is_search() {
			return is_search();
		}

		/**
		 * @return bool
		 */
		public function is_attachment() {
			return is_attachment();
		}

		/**
		 * @return bool
		 */
		public function is_front_page() {
			return is_front_page();
		}

		/**
		 * @return bool
		 */
		public function is_home() {
			return is_home();
		}

		/**
		 * @return bool
		 */
		public function is_single() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_single( $value );
		}

		/**
		 * @return bool
		 */
		public function is_single_page() {
			return is_single();
		}

		/**
		 * @return bool
		 */
		public function is_singular_page() {
			return is_singular();
		}

		/**
		 * @return bool
		 */
		public function is_sticky() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_sticky( $value );
		}

		/**
		 * @return bool
		 */
		public function is_page() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_page( $value );
		}

		/**
		 * @return bool
		 */
		public function is_paged() {
			return is_paged();
		}

		/**
		 * @return bool
		 */
		public function is_page_template() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_page_template( $value );
		}

		/**
		 * @return bool
		 */
		public function is_category() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_category( $value );
		}

		/**
		 * @return bool
		 */
		public function is_tag() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_tag( $value );
		}

		/**
		 * @return bool
		 */

		public function has_tag() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return has_tag( $value );
		}

		/**
		 * @return bool
		 */
		public function is_tax() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_tax( $value );
		}

		/**
		 * @return bool
		 */
		public function has_term() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return has_term( $value );
		}
	}
}