<?php
/*
 * Plugin Name: JSM's Show Comment Metadata
 * Text Domain: jsm-show-comment-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-comment-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-comment-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show comment metadata in a metabox when editing comments - a great tool for debugging issues with comment metadata.
 * Requires PHP: 7.2
 * Requires At Least: 5.2
 * Tested Up To: 6.1.1
 * Version: 3.0.7
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2023 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmScm' ) ) {

	class JsmScm {

		private static $instance = null;	// JsmScm class object.

		public function __construct() {

			if ( ! is_admin() ) return;	// This is an admin-only plugin.

			$plugin_dir = trailingslashit( dirname( __FILE__ ) );

			require_once $plugin_dir . 'lib/config.php';

			JsmScmConfig::set_constants( __FILE__ );

			JsmScmConfig::require_libs( __FILE__ );

			add_action( 'init', array( $this, 'init_textdomain' ) );
			add_action( 'init', array( $this, 'init_objects' ) );
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

		public function init_objects() {

			new JsmScmComment();
			new JsmScmScript();
		}
	}

	JsmScm::get_instance();
}
