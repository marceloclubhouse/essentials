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
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

function essentials_include_libsyn() {
    /* Include scripts and styles for Libsyn podcast feeds */
    wp_enqueue_script( 'essentials-libsyn-js', plugins_url( '../js/embed-libsyn.js', __FILE__ ));
    wp_enqueue_style( 'essentials-libsyn-css', plugins_url( '../css/embed-libsyn.css', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'essentials_include_libsyn');


function essentials_include_youtube_playlist() {
    /* Include scripts and styles for embedding YouTube playlists */
    wp_enqueue_script( 'essentials-youtube-playlist-js', plugins_url( '../js/embed-youtube-playlist.js', __FILE__ ));
    wp_enqueue_style( 'essentials-youtube-playlist-css', plugins_url( '../css/embed-youtube-playlist.css', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'essentials_include_youtube_playlist');
