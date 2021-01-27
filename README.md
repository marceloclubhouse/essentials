# Essentials
### A lightweight, multi-purpose plugin that adds essential features to WordPress
Essentials is an open-source WordPress plugin designed to deliver several general features without compromising usability.
A live demo is available at https://marcelocubillos.com/wordpress-essentials/
## Passive Features
* Fix Broken Custom CSS
### Fix Broken CSS
One of the issues that WordPress sites experience sometimes is that custom CSS doesn't save properly. As a result, some calls like "#body > div" turn into "#body \&gt; div" and web browsers fail to parse the call, leading to broken CSS.
This plugin automatically scans pages for "\&gt;" and forces them to become ">", so web browsers are able to render the CSS.
## Shortcodes
* Current Year
* iFrame
* Go-Back Link
* Embed Libsyn Podcast
* Embed YouTube Playlist
* Generate Google Pie Chart
* Create Top Banner
### Current Year - \[year\]
If you have a copyright clause anywhere in your website, you can add
```
Copyright &copy; [year] My Organization
```
### iFrame - \[iframe src *width *height\]
Enables iframe embeds anywhere within WordPress content.
```
[iframe src="https://marcelocubillos.com"]
```
Without specifying a width or height, the iframe defaults to a width and height of 400px. Otherwise, you can specify width and height.
```
[iframe src="https://marcelocubillos.com" width="1000px" height="500px"]
```
### Go-Back Link - \[back text\]
Creates an anchor that when clicked, has the same effect as a user clicking the back button in their web browser. This is useful if you have a 404 page and want to encourage your visitor to go back a page.
```
[back text="Perhaps try going back?"]
```
### Embed Libsyn Podcast - \[libsyn id entries\]
Create a grid of episodes from a Libsyn podcast. Entries specifies the max amount of episodes you want to load.
```
[libsyn id="313challenge" entries="1"]
```
If you set the entries to a negative number, there won't be any limit on the number of episodes pulled (do at your own risk).
```
[libsyn id="joeroganexp" entries="-1"]
```
This shortcode is written in JavaScript as to not use extra server performance, but it could slow down your visitors' PCs if too many episodes are loaded.
### Embed YouTube playlist - \[youtube-playlist id entries *cols\]
Create a grid of videos from a YouTube playlist.
To use this shortcode you will need a YouTube API key. See https://developers.google.com/youtube/registering_an_application for more information. After obtaining the key, the value must be updated in "/php/keys/YOUTUBE_API.php"
```
[youtube-playlist id="PL02HDVnTgIcqlWlZxvcJzWsMjxNPChGLf" entries="6" cols="3"]
```
Max specifies the max number of videos to display, and cols specifies the number of columns to display. If nothing is specified for cols then the table will default to 3 columns.
### Generate Google Pie Chart - \[google-pie-chart title data *width *height *display-title\]
Using this shortcode, you can generate and display a pie chart with parameters specified in the shortcode.

The data parameter of the shortcode follows the format "FirstCategory:Number,SecondCategory:Number", where each category is the name of the category, and the number represents the number of items in that category. For instance, a valid shortcode may look like:
```
[google-pie-chart title="What My Fancy Breakfasts Usually Consist Of" data="Bacon:4,Eggs:2,Oranges:1,Biscuits:2"]
```
You can specify the width and height of the shortcode using [google-pie-chart width="x" height="y"] where x and y are valid integers, though if they're not specified the pie chart will default to 900x500px.

You can also specify whether or not to include a title by including "display-title='false'" in the shortcode. If this parameter isn't specified, the title will be displayed by default.
### Create Top Banner - \[top-banner content *link *link_name *color]
Create a banner at the top of a site with an optional right-hand link (see https://dev.marcelocubillos.com/ for an example).
Colors are specified in the same syntax as CSS.
```
[top-banner content="This is my development site. For my main site, check out marcelocubillos.com" link="https://marcelocubillos.com" link_name="back to my main site" color="black"]
```
## License
This project is available under the MIT license. See LICENSE.txt for more information.
