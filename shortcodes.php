<?php
/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  shortcodes.php - Contains all shortcode functions for the
 *                   Essentials plugin.
 *
 *  Revisions:
 *      - 2020/08/27 : Initial revision
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

function essentialsYear( $atts )
{
    /*
    * Display the current year.
    * Shortcode: [year]
    */
    return date('Y');
}
add_shortcode( 'year', 'essentialsYear' );


function essentialsIframe( $atts )
{
    /*
     * Enable iframe embeds
     * Shortcode: [iframe src *width *height]
     *
     * src - The URL of the page the iframe will pull
     * width - The width of the iframe box
     * height - The height of the iframe box
     */
    // If width and height aren't provided then default to 400x400
    if (!$atts['width']) { $atts['width'] = 400; }
    if (!$atts['height']) { $atts['height'] = 400; }

    return "<iframe frameBorder='0' class='essentials-iframe'
            src='{$atts['src']}' width='{$atts['width']}' height='{$atts['height']}'></iframe>";
}
add_shortcode('iframe', 'essentialsIframe');


function essentialsLibsyn( $atts )
{
    /*
     * Enable Libsyn podcast embedding
     * Shortcode: [libsyn id entries]
     *
     * id - The ID of the Libsyn podcast e.g. "313challenge"
     * entries - The maximum amount of episodes to pull (if a
     * negative number is used then it will pull all episodes)
    */
    return "<div id='podcast-{$atts['id']}' class='podcast-feed'></div>
            <script>generateLibsynPodcast('{$atts['id']}', {$atts['entries']});</script>";
}
add_shortcode('libsyn', 'essentialsLibsyn');


function essentialsYoutubePlaylist ( $atts )
{
    /* Enable embedding YouTube playlists
     * Shortcode: [youtube-playlist id entries *cols]
     *
     * id - The ID of the YouTube playlist
     * entries - The maximum number of videos to pull (if
     * the number is negative then all videos from the playlist
     * will be pulled).
     * cols - The number of columns to include in the table
     * (this is optional and will default to 3).
    */

    // If the number of columns isn't specified then default to 3
    if (!$atts['cols']) { $atts['cols'] = 3; }

    // Grab the Youtube API key from the
    // global constant and store it as a string.
    $YOUTUBE_API_KEY = YOUTUBE_API_KEY;

    return "<div id='youtube-playlist-{$atts['id']}'></div>
            <style>.youtube-video { width: calc(1/${atts['cols']}*100%); }</style>
            <script>generateYouTubeplaylist('{$atts['id']}', {$atts['entries']}, '{$YOUTUBE_API_KEY}', {$atts['cols']});</script>";
}
add_shortcode('youtube-playlist', 'essentialsYoutubePlaylist');


function essentialsPieChart ( $atts )
{
    /* Enable generating and embedding pie charts using Google's
     * pie chart system.
     * Shortcode: [google-pie-chart title data *width *height]
     *
     * title - The title of the pie chart
     * data - The data to generate the chart using the format
     * "name:value" (e.g. "Art:6,Dance:7")
     * width - Optional parameter to specify the width of the chart
     * height - Optional parameter to specify the height of the chart
     */

    // If width and height aren't provided then default to 900x500.
    if (!$atts['width']) { $atts['width'] = 900; }
    if (!$atts['height']) { $atts['height'] = 500; }

    // Create an HTML-friendly title that can be used to address
    // the generated pie chart.
    $html_friendly_title = str_replace(' ', '', strtolower($atts['title']));

    $piechart_script = essentialsGeneratePiechartJS($atts['title'], $atts['data']);

    return "<div id='piechart{$html_friendly_title}' style=\"width: {$atts['width']}px; height: {$atts['height']}px;\"></div>
            <script>{$piechart_script}</script>";
}
add_shortcode('google-pie-chart', 'essentialsPieChart');


function essentialsBack( $atts )
{
    /* Enable a link to go back one page
     * Shortcode: [back text]
     *
     * text - The text used in the link
     */
    return '<a onclick="javascript:history.back()" href="#">' . $atts['text'] . '</a>';
}
add_shortcode('back', 'essentialsBack');
