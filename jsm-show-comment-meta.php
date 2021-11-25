<?php
/**
 * Plugin Name: JSM's Show Comment Metadata
 * Text Domain: jsm-show-comment-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-comment-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-comment-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show all comment meta (aka custom fields) in a metabox on comment editing pages.
 * Requires PHP: 7.2
 * Requires At Least: 5.2
 * Tested Up To: 5.8.2
 * Version: 2.0.0-dev.2
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmShowCommentMeta' ) ) {

	class JsmShowCommentMeta {

		private static $instance = null;	// JsmShowCommentMeta class object.

		private function __construct() {

			if ( is_admin() ) {

				add_action( 'plugins_loaded', array( $this, 'init_textdomain' ) );

				add_action( 'add_meta_boxes_comment', array( $this, 'add_meta_boxes_comment' ), 1000, 2 );
			}
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'jsm-show-comment-meta', false, 'jsm-show-comment-meta/languages/' );
		}

		public function add_meta_boxes_comment( $comment_obj ) {

			if ( ! isset( $comment_obj->comment_ID ) ) {	// Just in case.

				return;
			}

			$view_cap = apply_filters( 'jsm_scm_view_cap', 'manage_options' );

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

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_comment_metadata' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );
		}

		public function show_comment_metadata( $comment_obj ) {

			if ( empty( $comment_obj->comment_ID ) ) {

				return;
			}

			$comment_meta          = get_comment_meta( $comment_obj->comment_ID );
			$comment_meta_filtered = apply_filters( 'jsm_scm_comment_meta', $comment_meta, $comment_obj );
			$skip_keys_preg_match  = apply_filters( 'jsm_scm_skip_keys', array() );

			?>
			<style type="text/css">
				div#jsmscm.postbox table {
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}
				div#jsmscm.postbox table .key-column {
					width:30%;
				}
				div#jsmscm.postbox table tr.added-meta {
					background-color:#eee;
				}
				div#jsmscm.postbox table td {
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}
				div#jsmscm.postbox table td div {
					overflow-x:auto;
				}
				div#jsmscm.postbox table td div pre {
					margin:0;
					padding:0;
				}
			</style>
			<?php

			echo '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-comment-meta' ) . '</th>';

			echo '<th class="value-column">' . __( 'Value', 'jsm-show-comment-meta' ) . '</th></tr></thead><tbody>';

			ksort( $comment_meta_filtered );

			foreach( $comment_meta_filtered as $meta_key => $arr ) {

				foreach ( $skip_keys_preg_match as $preg_expr ) {

					if ( preg_match( $preg_expr, $meta_key ) ) {

						continue 2;
					}
				}

				if ( is_array( $arr ) ) {	// Just in case.

					foreach ( $arr as $num => $el ) {

						$arr[ $num ] = maybe_unserialize( $el );
					}
				}

				$is_added = isset( $comment_meta[ $meta_key ] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';

				echo '<td class="key-column"><div class="key-cell"><pre>' . esc_html( $meta_key ) . '</pre></div></td>';

				echo '<td class="value-column"><div class="value-cell"><pre>' . esc_html( var_export( $arr, true ) ) . '</pre></div></td></tr>' . "\n";
			}

			echo '</tbody></table>';
		}
	}

	JsmShowCommentMeta::get_instance();
}
