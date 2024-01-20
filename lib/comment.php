<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2024 Jean-Sebastien Morisset (https://surniaulula.com/)
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

		public function add_meta_boxes( $obj ) {

			if ( empty( $obj->comment_ID ) ) {

				return;
			}

			$comment_id = $obj->comment_ID;
			$show_cap   = apply_filters( 'jsmscm_show_metabox_capability', 'manage_options', $obj );
			$can_show   = current_user_can( $show_cap, $comment_id, $obj );

			if ( ! $can_show ) {

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

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_metabox' ),
				$metabox_screen, $metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox( WP_Comment $obj ) {

			echo $this->get_metabox( $obj );
		}

		public function get_metabox( WP_Comment $obj ) {

			if ( ! empty( $obj->comment_ID ) ) {

				$comment_id = $obj->comment_ID;

			} else return;

			$cf         = JsmScmConfig::get_config();
			$metadata   = get_metadata( 'comment', $comment_id );
			$skip_keys  = array();
			$metabox_id = 'jsmscm';
			$admin_l10n = $cf[ 'plugin' ][ 'jsmscm' ][ 'admin_l10n' ];

			$titles = array(
				'key'   => __( 'Key', 'jsm-show-comment-meta' ),
				'value' => __( 'Value', 'jsm-show-comment-meta' ),
			);

			return SucomUtilMetabox::get_table_metadata( $metadata, $skip_keys, $obj, $comment_id, $metabox_id, $admin_l10n, $titles );
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

			$metabox_id   = 'jsmscm';
			$obj_id       = SucomUtil::sanitize_int( $_POST[ 'obj_id' ] );
			$meta_key     = SucomUtil::sanitize_meta_key( $_POST[ 'meta_key' ] );
			$table_row_id = SucomUtil::sanitize_key( $metabox_id . '_' . $obj_id . '_' . $meta_key );
			$comment_obj  = get_comment( $obj_id );
			$delete_cap   = apply_filters( 'jsmstm_delete_meta_capability', 'manage_options', $comment_obj );
			$can_delete   = current_user_can( $delete_cap, $obj_id, $comment_obj );

			if ( ! $can_delete ) {

				die( -1 );

			} elseif ( delete_metadata( 'comment', $obj_id, $meta_key ) ) {

				die( $table_row_id );
			}

			die( false );	// Show delete failed message.
		}
	}
}
