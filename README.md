<h1>JSM Show Comment Metadata</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>JSM Show Comment Metadata</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>Show comment metadata in a metabox when editing comments - a great tool for debugging issues with comment metadata.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>4.2.0</td></tr>
<tr><th align="right" valign="top" nowrap>Requires PHP</th><td>7.2.34 or newer</td></tr>
<tr><th align="right" valign="top" nowrap>Requires WordPress</th><td>5.8 or newer</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To WordPress</th><td>6.5.0</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="https://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>comments, meta, metadata, delete, debug, inspector</td></tr>
</table>

<h2>Description</h2>

<p>The JSM Show Comment Metadata plugin displays comment meta keys and their unserialized values in a metabox at the bottom of comment editing pages.</p>

<p>There are no plugin settings - simply install and activate the plugin.</p>

<h4>Available Filters for Developers</h4>

<p>Filter the comment meta shown in the metabox:</p>

<pre><code>'jsmscm_metabox_table_metadata' ( array $metadata, $comment_obj )</code></pre>

<p>Array of regular expressions to exclude meta keys:</p>

<pre><code>'jsmscm_metabox_table_exclude_keys' ( array $exclude_keys, $comment_obj )</code></pre>

<p>Capability required to show comment meta:</p>

<pre><code>'jsmscm_show_metabox_capability' ( 'manage_options', $comment_obj )</code></pre>

<p>Capability required to delete comment meta:</p>

<pre><code>'jsmscm_delete_meta_capability' ( 'manage_options', $comment_obj )</code></pre>

<p>Icon for the delete comment meta button:</p>

<pre><code>'jsmscm_delete_meta_icon_class' ( 'dashicons dashicons-table-row-delete' )</code></pre>

<h4>Related Plugins</h4>

<ul>
<li><a href="https://wordpress.org/plugins/jsm-show-comment-meta/">JSM Show Comment Metadata</a></li>
<li><a href="https://github.com/jsmoriss/jsm-show-order-meta/">JSM Show Order Metadata for WooCommerce</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-post-meta/">JSM Show Post Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-term-meta/">JSM Show Term Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-user-meta/">JSM Show User Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-registered-shortcodes/">JSM Show Registered Shortcodes</a></li>
</ul>

