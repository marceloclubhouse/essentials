/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  top-banner.js - Generate a banner on the top of a site
 *
 *  Revisions:
 *      - 2020/09/08 : Initial revision
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 *
 */

function generateBanner(content, link="null", link_name="null", color="#ffffff")
{
    /* Generate a banner on the top of a site.

    This function inserts a banner after <head> in
    the HTML.

    @param {string} name - The content (text) to display in the banner
    @param {string} link - The URL of the rightmost link
    @param {string} link_name - The text to display on the rightmost link
    @param {string} bg_color - The background color of the banner (defaults to white)

    @return {null}
    */

    // Only generate the link on the right if both the link URL
    // and text are specified
    let col_link = "";
    if(link !== "null" && link_name !== "null")
    {
        col_link = `<td id=\"top-banner-link\"><a href=\"${link}\">${link_name}</a></td>`;
    }

    let raw_html =
        `
        <div id="top-banner" style="background-color: ${color}">
            <table>
                <tbody>
                    <tr>
                        <td id="top-banner-content">${content}</td>
                        ${col_link}
                    </tr>
                </tbody>
            </table>
        </div>
        `;

    document.head.insertAdjacentHTML("afterEnd", raw_html);
}