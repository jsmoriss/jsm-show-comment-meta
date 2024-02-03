=== JSM Show Comment Metadata ===
Plugin Name: JSM Show Comment Metadata
Plugin Slug: jsm-show-comment-meta
Text Domain: jsm-show-comment-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-comment-meta/assets/
Tags: comments, meta, metadata, delete, debug, inspector
Contributors: jsmoriss
Requires PHP: 7.2.34
Requires At Least: 5.8
Tested Up To: 6.4.3
Stable Tag: 4.0.0

Show comment metadata in a metabox when editing comments - a great tool for debugging issues with comment metadata.

== Description ==

The JSM Show Comment Metadata plugin displays comment meta keys and their unserialized values in a metabox at the bottom of comment editing pages.

There are no plugin settings - simply install and activate the plugin.

= Available Filters for Developers =

Filter the comment meta shown in the metabox:

<pre><code>'jsmscm_metabox_table_metadata' ( array $metadata, $comment_obj )</code></pre>

Array of regular expressions to exclude meta keys:

<pre><code>'jsmscm_metabox_table_exclude_keys' ( array $exclude_keys, $comment_obj )</code></pre>

Capability required to show comment meta:

<pre><code>'jsmscm_show_metabox_capability' ( 'manage_options', $comment_obj )</code></pre>

Capability required to delete comment meta:

<pre><code>'jsmscm_delete_meta_capability' ( 'manage_options', $comment_obj )</code></pre>

Icon for the delete comment meta button:

<pre><code>'jsmscm_delete_meta_icon_class' ( 'dashicons dashicons-table-row-delete' )</code></pre>

= Related Plugins =

* [JSM Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
* [JSM Show Order Metadata for WooCommerce](https://wordpress.org/plugins/jsm-show-order-meta/)
* [JSM Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM Show Term Metadata](https://wordpress.org/plugins/jsm-show-term-meta/)
* [JSM Show User Metadata](https://wordpress.org/plugins/jsm-show-user-meta/)
* [JSM Show Registered Shortcodes](https://wordpress.org/plugins/jsm-show-registered-shortcodes/)

== Installation ==

== Frequently Asked Questions ==

== Screenshots ==

01. The "Comment Metadata" metabox added to admin comment editing pages.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes and/or incompatible API changes (ie. breaking changes).
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-comment-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-comment-meta/)

<h3>Changelog / Release Notes</h3>

**Version 4.1.0 (2024/02/03)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Added a new `SucomUtilWP::doing_dev()` method.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.

**Version 4.0.0 (2024/01/20)**

* **New Features**
	* None.
* **Improvements**
	* Allow upper case and accents in metadata keys.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Added `$comment_obj` argument to `current_user_can()`.
	* Added new `SucomUtil::sanitize_int()` method.
	* Added new `SucomUtil::sanitize_meta_key()` method.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.

== Upgrade Notice ==

= 4.1.0 =

(2024/02/03) Added a new `SucomUtilWP::doing_dev()` method.

= 4.0.0 =

(2024/01/20) Allow upper case and accents in metadata keys.

