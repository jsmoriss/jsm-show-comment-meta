=== JSM Show Comment Metadata ===
Plugin Name: JSM Show Comment Metadata
Plugin Slug: jsm-show-comment-meta
Text Domain: jsm-show-comment-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-comment-meta/assets/
Tags: meta, comment meta, delete, debug, inspector
Contributors: jsmoriss
Requires PHP: 7.2.34
Requires At Least: 5.5
Tested Up To: 6.4.0
Stable Tag: 3.6.0

Show comment metadata in a metabox when editing comments - a great tool for debugging issues with comment metadata.

== Description ==

**The JSM Show Comment Metadata plugin displays comment meta keys and their unserialized values in a metabox at the bottom of comment editing pages.**

The current user must have the [WordPress *manage_options* capability](https://wordpress.org/support/article/roles-and-capabilities/#manage_options) (allows access to administration options) to view the Comment Metadata metabox, and the *manage_options* capability to delete individual meta keys.

The default *manage_options* capability can be modified using the 'jsmscm_show_metabox_capability' and 'jsmscm_delete_meta_capability' filters (see filters.txt in the plugin folder).

There are no plugin settings - simply install and activate the plugin.

= Related Plugins =

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

**Version 3.6.0 (2023/11/08)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Update for the `SucomUtil` and `SuextMinifyCssCompressor` class.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.5.

== Upgrade Notice ==

= 3.6.0 =

(2023/11/08) Update for the `SucomUtil` and `SuextMinifyCssCompressor` class.

