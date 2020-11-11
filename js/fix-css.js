/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  fix-css.js - Fix faulty custom-CSS implementations in
 *               some versions of WordPress.
 *
 *  Revisions:
 *      - 2020/10/28 : Initial revision
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

// replaceAll provided by: https://www.codegrepper.com/code-examples/javascript/replace+every+occurrence+javascript
function replaceAll(str, find, replace) {
    /* Replace all instances of a str within a str with a different str
     * @return {str}
     */
    let escapedFind=find.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
    return str.replace(new RegExp(escapedFind, 'g'), replace);
}

function forceInheritance()
{
    /* Force "&gt;" to become ">" in WordPress' custom CSS.
     * @return {null}
     */
    let custom_css = document.getElementById("wp-custom-css").innerHTML;
    let parsed_css = replaceAll(custom_css, "&gt;", ">");
    document.getElementById("wp-custom-css").innerHTML = parsed_css;
}
forceInheritance();