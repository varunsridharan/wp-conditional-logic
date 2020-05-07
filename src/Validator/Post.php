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

use WP_Post;

defined( 'ABSPATH' ) || exit;

if ( ! trait_exists( '\Varunsridharan\WordPress\WP_Conditional_Logic\Validator\Post' ) ) {
	/**
	 * Trait Post
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic\Validator
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	trait Post {
		/**
		 * Returns Current POST ID.
		 *
		 * @return bool|mixed
		 */
		public function post_id() {
			return get_the_ID();
		}

		/**
		 * Returns Current Post Post Type.
		 *
		 * @return bool|mixed
		 */
		public function post_type() {
			return get_post_type();
		}

		/**
		 * Returns Current Post Title.
		 *
		 * @return bool|mixed
		 */
		public function post_title() {
			return get_the_title();
		}

		/**
		 * Returns Current Post Slug / Name.
		 *
		 * @return bool|mixed
		 */
		public function post_name() {
			global $post;
			return ( $post instanceof WP_Post ) ? $post->post_name : false;
		}

		/**
		 * Returns Curent Post Content.
		 *
		 * @return bool|mixed
		 */
		public function post_content() {
			return get_the_content();
		}

		/**
		 * Returns Current Post Terms for a taxonomy.
		 *
		 * @return bool|mixed
		 * @example
		 * array('post_terms','operator','term_id | term_slug | term_name')
		 * array('post_terms','operator',array(
		 *    'value' => 'term_id | term_slug | term_name',
		 *    'taxonomy' => array(
		 *        'taxonomy' => 'post taxonomy slug',
		 *        'fields' => 'ids|names|slugs'
		 *    ),
		 * ))
		 */
		public function post_terms() {
			$taxonomy = $this->get_value( 'taxonomy' );
			$exarg    = array();
			$sysval   = null;
			if ( is_numeric( $this->get_value() ) ) {
				$exarg = array( 'fields' => 'ids' );
			}

			if ( is_array( $taxonomy ) ) {
				$_args    = $taxonomy;
				$taxonomy = ( isset( $_args['taxonomy'] ) ) ? $_args['taxonomy'] : false;
				unset( $_args['taxonomy'] );
				$exarg = wp_parse_args( $_args, $exarg );
				unset( $_args );
			} elseif ( ! is_numeric( $this->get_value() ) && ! is_array( $exarg ) ) {
				$exarg = array( 'fields' => 'ids' );
			}

			$data = wp_get_post_terms( get_the_ID(), $taxonomy, $exarg );

			if ( is_object( $data[0] ) ) {
				$data = wp_list_pluck( $data, 'term_id' );
			}

			return $data;
		}
	}
}
