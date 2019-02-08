<?php

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'Varunsridharan\WordPress\WP_Conditional_Logic\Common_Is_Functions' ) ) {
	/**
	 * Class Frontend_Pages
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Common_Is_Functions extends Users {

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_404( $condition = array() ) {
			return $this->compare_return( $condition, is_404() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_admin( $condition = array() ) {
			return $this->compare_return( $condition, is_admin() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_date( $condition = array() ) {
			return $this->compare_return( $condition, is_date() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_year( $condition = array() ) {
			return $this->compare_return( $condition, is_year() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_month( $condition = array() ) {
			return $this->compare_return( $condition, is_month() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_day( $condition = array() ) {
			return $this->compare_return( $condition, is_day() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_time( $condition = array() ) {
			return $this->compare_return( $condition, is_time() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_new_day( $condition = array() ) {
			return $this->compare_return( $condition, is_new_day() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_multi_author( $condition = array() ) {
			return $this->compare_return( $condition, is_multi_author() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function comments_open( $condition = array() ) {
			return $this->compare_return( $condition, comments_open() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_post_type_hierarchical( $condition = array() ) {
			return $this->compare_return( $condition, is_post_type_hierarchical( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_post_type_archive( $condition = array() ) {
			return $this->compare_return( $condition, is_post_type_archive( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_author( $condition = array() ) {
			return $this->compare_return( $condition, is_author( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_network_admin( $condition = array() ) {
			return $this->compare_return( $condition, is_network_admin() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_ajax( $condition = array() ) {
			return $this->compare_return( $condition, ( defined( 'DOING_AJAX' ) && true === DOING_AJAX ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_cron( $condition = array() ) {
			return $this->compare_return( $condition, ( defined( 'DOING_CRON' ) && true === DOING_CRON ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_archive( $condition = array() ) {
			return $this->compare_return( $condition, is_archive() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_search( $condition = array() ) {
			return $this->compare_return( $condition, is_search() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_attachment( $condition = array() ) {
			return $this->compare_return( $condition, is_attachment() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_front_page( $condition = array() ) {
			return $this->compare_return( $condition, is_front_page() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_home( $condition = array() ) {
			return $this->compare_return( $condition, is_home() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_single( $condition = array() ) {
			return $this->compare_return( $condition, is_single( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_single_page( $condition = array() ) {
			return $this->compare_return( $condition, is_single() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_singular_page( $condition = array() ) {
			return $this->compare_return( $condition, is_singular() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_sticky( $condition = array() ) {
			return $this->compare_return( $condition, is_sticky( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_page( $condition = array() ) {
			return $this->compare_return( $condition, is_page( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_paged( $condition = array() ) {
			return $this->compare_return( $condition, is_paged() );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_page_template( $condition = array() ) {
			return $this->compare_return( $condition, is_page_template( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_category( $condition = array() ) {
			return $this->compare_return( $condition, is_category( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_tag( $condition = array() ) {
			return $this->compare_return( $condition, is_tag( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function has_tag( $condition = array() ) {
			return $this->compare_return( $condition, has_tag( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function is_tax( $condition = array() ) {
			return $this->compare_return( $condition, is_tax( $this->get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function has_term( $condition = array() ) {
			return $this->compare_return( $condition, has_term( $this->get_extra_arg( $condition ) ) );
		}
	}
}
