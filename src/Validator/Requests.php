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

defined( 'ABSPATH' ) || exit;

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
			return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}

		/**
		 * @return bool
		 */
		public function is_ajax_action() {
			if ( defined( 'DOING_AJAX' ) && true === DOING_AJAX ) {
				return ( isset( $_REQUEST['action'] ) && ! empty( $_REQUEST['action'] ) );
			}
			return false;
		}

		/**
		 * @return bool
		 */
		public function comments_open() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return comments_open( $value );
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
		public function is_attachment() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_attachment( $value );
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
			return $this->is_single();
		}

		/**
		 * @return bool
		 */
		public function is_singular_page() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_singular( $value );
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
			$value = ( true === $this->get_value() ) ? '' : $this->get_value();
			return is_page( $value );
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

		/**
		 * @return bool
		 */
		public function is_taxonomy_hierarchical() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return is_taxonomy_hierarchical( $value );
		}

		/**
		 * @return bool
		 */
		public function has_excerpt() {
			$value = ( true === $this->get_value() ) ? null : $this->get_value();
			return has_excerpt( $value );
		}
	}
}
