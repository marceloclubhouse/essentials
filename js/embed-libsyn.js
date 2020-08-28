/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  embed-libsyn.js - Embed a Libsyn podcast feed in your site.
 *
 *  Revisions:
 *      - 2020/08/27 : Initial revision
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

function generateLibsynPodcast(libsyn_id, max_entries)
{
    /* Generate a feed of podcast episodes from libsyn.com.

       This function uses Libsyn's RSS feed to generate a feed
       of the latest podcast episodes of a show based on the
       given Libsyn ID. Given that there exists a div with the ID
       "podcast-${libsyn_id}" this function will populate that
       div when called.

       @param {string} libsyn_id - The ID of the podcast
       @param {number} max_entries - The maximum number of episodes to pull

       @return {null}
     */
    const RSS_URL = `https://${libsyn_id}.libsyn.com/rss`;
    const MAX_ENTRIES = max_entries;
    // Bad characters: {, }, <, >
    const RE = RegExp('^[{}<>]*$');

    fetch(RSS_URL)
        .then(response => response.text())
        .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
        .then(data =>
        {
            const ITEMS = data.querySelectorAll("item");
            let num_entries = 0;
            let html = ``;
            for (let el of ITEMS)
            {

                if (num_entries === MAX_ENTRIES)
                {
                    break;
                }

                let title = el.querySelector("title").innerHTML;

                // Parse Linsyn links into usable URL's
                let link = el.querySelector("link").innerHTML;
                link = link.slice(9, link.length - 3);

                // Parse description to exclude closing data
                let description = el.querySelector("description").innerHTML;
                description = description.slice(0, description.length - 3);

                // Parse date
                let pubDate = el.querySelector("pubDate").innerHTML;
                pubDate = pubDate.slice(4, 16);

                // Parse image
                let thumbnail = el.querySelector("image").getAttribute('href');

                // Test if title and description contain bad characters
                if (title.match(RE))
                {
                    title = `Title contains bad chars`;
                }
                else if (description.match(RE))
                {
                    description = `Description contains bad chars`;
                }

                html += `
                        <div class="podcast-episode">
                          <a href="${link}" target="_blank" rel="noopener">
                            <h2 class="podcast-episode-title">${title}</h2>
                            <img src="${thumbnail}" style="width: 20%; float: left;" class="podcast-episode-image">
                          </a>
                          <strong class="podcast-episode-date">Published: ${pubDate}</strong>
                          <p class="podcast-episode-description">${description}</p>
                        </div>
                      `;

                num_entries++;
            }

            document.getElementById(`podcast-${libsyn_id}`).innerHTML = html;

        });
}