<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! defined( 'JSMSCM_PLUGINDIR' ) ) {

	die( 'Do. Or do not. There is no try.' );
}

if ( ! class_exists( 'JsmScmComment' ) ) {

	class JsmScmComment {

		public function __construct() {

			add_action( 'add_meta_boxes_comment', array( $this, 'add_meta_boxes' ), 1000, 1 );
		}

		public function add_meta_boxes( $comment_obj ) {

			if ( ! isset( $comment_obj->comment_ID ) ) {	// Just in case.

				return;
			}

			$view_cap = apply_filters( 'jsmscm_view_cap', 'manage_options' );

			if ( ! current_user_can( $view_cap, $comment_obj->comment_ID ) ) {

				return;
			}

			$metabox_id      = 'jsmscm';
			$metabox_title   = __( 'Comment Metadata', 'jsm-show-comment-meta' );
			$metabox_screen  = null;
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_metabox' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox( $comment_obj ) {

			echo $this->get_metabox( $comment_obj );
		}

		public function get_metabox( $comment_obj ) {

			if ( empty( $comment_obj->comment_ID ) ) {

				return;
			}

			$comment_meta = get_comment_meta( $comment_obj->comment_ID );
			$skip_keys    = array();
			$metabox_id   = 'jsmscm';
			$key_title    = __( 'Key', 'jsm-show-comment-meta' );
			$value_title  = __( 'Value', 'jsm-show-comment-meta' );

			return SucomUtilMetabox::get_table_metadata( $comment_meta, $skip_keys, $comment_obj, $metabox_id, $key_title, $value_title );
		}
	}
}
