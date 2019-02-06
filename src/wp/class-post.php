<?php

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'Varunsridharan\WordPress\WP_Conditional_Logic\Post' ) ) {
	/**
	 * Class Post
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Post extends Common_Is_Functions {
		/**
		 * Returns Current POST ID.
		 *
		 * @param array $condition
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function post_id( $condition = array() ) {
			return self::compare_return( $condition, get_the_ID() );
		}

		/**
		 * Returns Current Post Post Type.
		 *
		 * @param $compare
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function post_type( $compare ) {
			return self::compare_return( $compare, get_post_type() );
		}

		/**
		 * Returns Current Post Title.
		 *
		 * @param $compare
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function post_title( $compare ) {
			return self::compare_return( $compare, get_the_title() );
		}

		/**
		 * Returns Current Post Slug / Name.
		 *
		 * @param $compare
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function post_name( $compare ) {
			global $post;
			if ( $post instanceof \WP_Post ) {
				return self::compare_return( $compare, $post->post_name );
			}
			return false;
		}

		/**
		 * Returns Curent Post Content.
		 *
		 * @param $compare
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function post_content( $compare ) {
			return self::compare_return( $compare, get_the_content() );
		}

		/**
		 * Returns Current Post Terms for a taxonomy.
		 *
		 * @example
		 * array('post_terms','operator','term_id | term_slug | term_name','taxonomy')
		 * array('post_terms','operator','term_id | term_slug | term_name',array('taxonomy' => 'post taxonomy slug','fields' => 'ids|names|slugs'))
		 *
		 * @param $compare
		 *
		 * @static
		 * @return bool|mixed
		 */
		public static function post_terms( $compare ) {
			$extra    = self::get_extra_arg( $compare );
			$taxonomy = $extra;
			$exarg    = array();
			$sysval   = null;
			if ( is_numeric( $compare['value'] ) ) {
				$exarg            = array( 'fields' => 'ids' );
				$compare['value'] = intval( $compare['value'] );
			}

			if ( is_array( $extra ) ) {
				$taxonomy = ( isset( $extra['taxonomy'] ) ) ? $extra['taxonomy'] : false;
				unset( $extra['taxonomy'] );
				$exarg = wp_parse_args( $extra, $exarg );
				unset( $extra );
			} elseif ( ! is_numeric( $compare['value'] ) && ! is_array( $exarg ) ) {
				$exarg = array( 'fields' => 'ids' );
			}

			$data = wp_get_post_terms( get_the_ID(), $taxonomy, $exarg );

			if ( is_object( $data[0] ) ) {
				$data = wp_list_pluck( $data, 'term_id' );
			}

			return self::compare_return( $compare, $data );
		}
	}
}
