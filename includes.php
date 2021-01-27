<?php
/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  includes.php - Executes include statements for all Essentials
 *                 plugin assets.
 *
 *  Revisions:
 *      - 2020/08/27 : Initial revision
 *      - 2020/10/26 : Added includes for Google Pie Chart scripts
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

// Include PHP scripts
include 'php/embed-piechart.php';

// Include API keys
include 'php/keys/YOUTUBE_API.php';

// Include scripts and styles
function essentialsIncludeLibsyn() {
    /* Include scripts and styles for Libsyn podcast feeds */
    wp_enqueue_script( 'essentials-libsyn', plugins_url( '/js/embed-libsyn.js', __FILE__ ));
    wp_enqueue_style( 'essentials-libsyn', plugins_url( '/css/embed-libsyn.css', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'essentialsIncludeLibsyn');


function essentialsIncludeYoutubePlaylist() {
    /* Include scripts and styles for embedding YouTube playlists */
    wp_enqueue_script( 'essentials-youtube-playlist', plugins_url( '/js/embed-youtube-playlist.js', __FILE__ ));
    wp_enqueue_style( 'essentials-youtube-playlist', plugins_url( '/css/embed-youtube-playlist.css', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'essentialsIncludeYoutubePlaylist');


function essentialsIncludeGooglePieChart() {
    /* Include scripts for generating and displaying Google Pie Charts */

    // GStatic chart needs to be loaded in the header
    wp_enqueue_script( 'gstatic-chart-loader', plugins_url( '/js/loader.js', __FILE__ )); // GStatic loader

}
add_action('wp_enqueue_scripts', 'essentialsIncludeGooglePieChart');


function essentialsIncludeCSSFix() {
    /* Include scripts for fixing faulty custom CSS */

    // Fix CSS script must be queued in the footer
    wp_enqueue_script( 'essentials-css-fix', plugins_url( '/js/fix-css.js', __FILE__), false, false, true);
}
add_action('wp_enqueue_scripts', 'essentialsIncludeCSSFix');


function essentialsIncludeTopBanner() {
    /* Include scripts for fixing faulty custom CSS within WordPress' Custom CSS system */
    wp_enqueue_script( 'essentials-top-banner', plugins_url( '/js/top-banner.js', __FILE__));
    wp_enqueue_style( 'essentials-top-banner', plugins_url( '/css/top-banner.css', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'essentialsIncludeTopBanner');
