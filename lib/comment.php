<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2022 Jean-Sebastien Morisset (https://surniaulula.com/)
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
			add_action( 'wp_ajax_delete_jsmscm_meta', array( $this, 'ajax_delete_meta' ) );
		}

		public function add_meta_boxes( $comment_obj ) {

			if ( ! isset( $comment_obj->comment_ID ) ) {	// Just in case.

				return;
			}

			$show_meta_cap = apply_filters( 'jsmscm_show_metabox_capability', 'manage_options', $comment_obj );
			$can_show_meta = current_user_can( $show_meta_cap, $comment_obj->ID );

			if ( ! $can_show_meta ) {

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

			$cf           = JsmScmConfig::get_config();
			$comment_meta = get_comment_meta( $comment_obj->comment_ID );
			$skip_keys    = array();
			$metabox_id   = 'jsmscm';
			$admin_l10n   = $cf[ 'plugin' ][ 'jsmscm' ][ 'admin_l10n' ];

			$titles = array(
				'key'   => __( 'Key', 'jsm-show-comment-meta' ),
				'value' => __( 'Value', 'jsm-show-comment-meta' ),
			);

			return SucomUtilMetabox::get_table_metadata( $comment_meta, $skip_keys, $comment_obj, $comment_obj->comment_ID, $metabox_id, $admin_l10n, $titles );
		}

		public function ajax_delete_meta() {

			$doing_ajax = SucomUtilWP::doing_ajax();

			if ( ! $doing_ajax ) {	// Just in case.

				return;
			}

			check_ajax_referer( JSMSCM_NONCE_NAME, '_ajax_nonce', $die = true );

			if ( empty( $_POST[ 'obj_id' ] ) || empty( $_POST[ 'meta_key' ] ) ) {

				die( -1 );
			}

			/*
			 * Note that the $table_row_id value must match the value used in SucomUtilMetabox::get_table_metadata(),
			 * so that jQuery can hide the table row after a successful delete.
			 */
			$metabox_id   = 'jsmscm';
			$obj_id       = sanitize_key( $_POST[ 'obj_id' ] );
			$meta_key     = sanitize_key( $_POST[ 'meta_key' ] );
			$table_row_id = sanitize_key( $metabox_id . '_' . $obj_id . '_' . $meta_key );
			$comment_obj  = get_comment( $obj_id );
			$del_meta_cap = apply_filters( 'jsmstm_delete_meta_capability', 'manage_options', $comment_obj );
			$can_del_meta = current_user_can( $del_meta_cap, $obj_id );

			if ( ! $can_del_meta ) {

				die( -1 );
			}

			if ( delete_comment_meta( $obj_id, $meta_key ) ) {

				die( $table_row_id );
			}

			die( false );	// Show delete failed message.
		}
	}
}
