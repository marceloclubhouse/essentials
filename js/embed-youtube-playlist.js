/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  embed-youtube-playlist.js - Embed a YouTube playlist in your site.
 *
 *  Revisions:
 *      - 2020/08/28 : Initial revision
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

function generateYouTubeplaylist(playlist_id, max_entries, cols=3)
{
    /* Generate a feed of videos from a YouTube playlist.

       This function uses YouTube's API to request info
       about a specified YouTube playlist, creates a
       table containing the video titles, thumbnails,
       upload dates, and descriptions, and inserts it into
       a div with the id "youtube-playlist-${playlist_id}".

       @param {string} playlist_id - The ID of YouTube playlist
       @param {number} max_entries - The maximum number of videos to display
       @param {number} cols - The number of columns to use in the table (defaults to 3)

       @return {null}
     */
    let xmlhttp = new XMLHttpRequest();
    // You'll probably want to replace the API key with something
    // other than the default Essentials key.
    const YOUTUBE_API_KEY = "ENTER_API_KEY_HERE";
    const PLAYLIST_ID = playlist_id;
    const MAX_ENTRIES = max_entries;
    const URL = `https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=${MAX_ENTRIES}&playlistId=${PLAYLIST_ID}&key=${YOUTUBE_API_KEY}`;

    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            let youtubeJSON = JSON.parse(this.responseText);
            buildPlaylist(youtubeJSON, cols);
        }
    };
    xmlhttp.open("GET", URL, true);
    xmlhttp.send();

    function buildPlaylist(arr, num_col)
    {
        /* Generate and insert the playlist into the HTML.

        @param {array} arr - The parsed JSON file from YouTube
        @param {number} num_col - The number of columns the table will have

        @return {null}
        */
        let html = `<table class="youtube-playlist-table" style="width: 100%;"><tbody>`;
        // If the resolution of the images are unsatisfactory, the quality can
        // be changed per the API guidelines:
        // https://developers.google.com/youtube/v3/docs/thumbnails
        const QUALITY = 'medium';
        // If the description length exceeds 200 characters, then it
        // will be delimited to 200 characters with "..." at the end.
        // (this length is arbitrary and can be changed)
        const MAX_LENGTH = 200;

        for(let i = 0; i < arr['items'].length; i++)
        {
            let title = arr['items'][i]['snippet']['title'];
            let link = 'https://www.youtube.com/watch?v=' + arr['items'][i]['snippet']['resourceId']['videoId'];
            let description = arr['items'][i]['snippet']['description'];

            if (description.length > MAX_LENGTH)
            {
                description = description.slice(0, MAX_LENGTH) + '...';
            }

            let thumbnail = arr['items'][i]['snippet']['thumbnails'][QUALITY]['url'];
            let publishDate = arr['items'][i]['snippet']['publishedAt'].slice(0, 10);

            // If the current video is in the last column
            // e.g. the table is 3 columns and this is
            // the 3rd video in the 3rd column or
            // the 9th video in the 3rd column then create
            // a new row of videos.
            if (i % num_col === 0)
            {
                html += `<tr>`;
            }

            html += `
                    <th class="youtube-video">
                        <a href="${link}" target="_blank">
                            <img src="${thumbnail}" class="youtube-video-thumbnail">
                            <h2 class="youtube-video-title">${title}</h2>
                        </a>
                        <strong class="youtube-video-date">Published: ${publishDate}</strong>
                        <p class="youtube-video-description">${description}</p>
                    </th>
                    `;

            // If this is the last video in the columns
            // then end the row.
            if (i % num_col === num_col - 1)
            {
                html += `</tr>`;
            }
        }
        html += `</tbody></table>`;
        document.getElementById(`youtube-playlist-${playlist_id}`).innerHTML = html;
    }
}