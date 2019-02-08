<?php

namespace Varunsridharan\WordPress\WP_Conditional_Logic;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'Varunsridharan\WordPress\WP_Conditional_Logic\Hooks' ) ) {
	/**
	 * Class Hooks
	 *
	 * @package Varunsridharan\WordPress\WP_Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Hooks extends Post {
		/**
		 * @param $condition
		 *
		 * @return mixed
		 */
		private function hook_fix_arg( $condition ) {
			if ( empty( $condition['extra'] ) && ! empty( $condition['value'] ) ) {
				$condition['extra'] = $condition['value'];
				$condition['value'] = true;
			}
			return $condition;
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function did_action( $condition = array() ) {
			$condition = $this->hook_fix_arg( $condition );
			$sys_val   = $this->call_func( 'has_action', $condition );
			$sys_val   = ( true === $condition['value'] && 1 === $sys_val ) ? true : $sys_val;
			return $this->compare_return( $condition, $sys_val );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function has_action( $condition = array() ) {
			$condition = $this->hook_fix_arg( $condition );
			$sys_val   = $this->call_func( 'has_action', $condition );
			$sys_val   = ( true === $condition['value'] && false !== $sys_val ) ? true : $sys_val;
			return $this->compare_return( $condition, $sys_val );
		}

		/**
		 * @param array $condition
		 *
		 * @return bool|mixed
		 */
		public function has_filter( $condition = array() ) {
			$condition = $this->hook_fix_arg( $condition );
			$sys_val   = $this->call_func( 'has_filter', $condition );
			$sys_val   = ( true === $condition['value'] && false !== $sys_val ) ? true : $sys_val;
			return $this->compare_return( $condition, $sys_val );
		}
	}
}
