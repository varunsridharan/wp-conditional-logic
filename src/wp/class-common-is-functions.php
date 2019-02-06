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
		 * @static
		 * @return bool|mixed
		 */
		public static function is_404( $condition = array() ) {
			return self::compare_return( $condition, is_404() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_admin( $condition = array() ) {
			return self::compare_return( $condition, is_admin() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_date( $condition = array() ) {
			return self::compare_return( $condition, is_date() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_year( $condition = array() ) {
			return self::compare_return( $condition, is_year() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_month( $condition = array() ) {
			return self::compare_return( $condition, is_month() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_day( $condition = array() ) {
			return self::compare_return( $condition, is_day() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_time( $condition = array() ) {
			return self::compare_return( $condition, is_time() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_new_day( $condition = array() ) {
			return self::compare_return( $condition, is_new_day() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_multi_author( $condition = array() ) {
			return self::compare_return( $condition, is_multi_author() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function comments_open( $condition = array() ) {
			return self::compare_return( $condition, comments_open() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_post_type_hierarchical( $condition = array() ) {
			return self::compare_return( $condition, is_post_type_hierarchical( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_post_type_archive( $condition = array() ) {
			return self::compare_return( $condition, is_post_type_archive( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_author( $condition = array() ) {
			return self::compare_return( $condition, is_author( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_network_admin( $condition = array() ) {
			return self::compare_return( $condition, is_network_admin() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_ajax( $condition = array() ) {
			return self::compare_return( $condition, ( defined( 'DOING_AJAX' ) && true === DOING_AJAX ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_cron( $condition = array() ) {
			return self::compare_return( $condition, ( defined( 'DOING_CRON' ) && true === DOING_CRON ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_archive( $condition = array() ) {
			return self::compare_return( $condition, is_archive() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_search( $condition = array() ) {
			return self::compare_return( $condition, is_search() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_attachment( $condition = array() ) {
			return self::compare_return( $condition, is_attachment() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_front_page( $condition = array() ) {
			return self::compare_return( $condition, is_front_page() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_home( $condition = array() ) {
			return self::compare_return( $condition, is_home() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_single( $condition = array() ) {
			return self::compare_return( $condition, is_single( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_single_page( $condition = array() ) {
			return self::compare_return( $condition, is_single() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_singular_page( $condition = array() ) {
			return self::compare_return( $condition, is_singular() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_sticky( $condition = array() ) {
			return self::compare_return( $condition, is_sticky( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_page( $condition = array() ) {
			return self::compare_return( $condition, is_page( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_paged( $condition = array() ) {
			return self::compare_return( $condition, is_paged() );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_page_template( $condition = array() ) {
			return self::compare_return( $condition, is_page_template( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_category( $condition = array() ) {
			return self::compare_return( $condition, is_category( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_tag( $condition = array() ) {
			return self::compare_return( $condition, is_tag( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function has_tag( $condition = array() ) {
			return self::compare_return( $condition, has_tag( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function is_tax( $condition = array() ) {
			return self::compare_return( $condition, is_tax( self::get_extra_arg( $condition ) ) );
		}

		/**
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function has_term( $condition = array() ) {
			return self::compare_return( $condition, has_term( self::get_extra_arg( $condition ) ) );
		}
	}
}
