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
			return self::compare_return( $condition, is_sticky() );
		}
	}
}
