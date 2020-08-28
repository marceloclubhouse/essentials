# Essentials
## A lightweight, multi-purpose plugin to extend WordPress’ functionality
Essentials is an open-source WordPress plugin designed to deliver several general features without compromising usability.
A live demo is available at https://marcelocubillos.com/wordpress-essentials/
## Shortcodes
* Current Year
* iFrame
* Go-Back Link
* Embed Libsyn Podcast
* Embed YouTube Playlist
### Current Year - \[year\]
If you have a copyright clause anywhere in your website, you can add
```
Copyright &copy; [year] My Organization
```
### iFrame - \[iframe src *width *height\]
Enables iframe embeds anywhere within WordPress content.
```
[iframe src="//marcelocubillos.com"]
```
Without specifying a width or height, the iframe defaults to a width and height of 400px. Otherwise, you can specify width and height.
```
[iframe src="//marcelocubillos.com" width="1000px" height="500px"]
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
To use this shortcode you will need a YouTube API key. See https://developers.google.com/youtube/registering_an_application for more information. After obtaining the key, the value must be updated in "/js/embed-youtube-playlist.js"
```
[youtube-playlist id="PL02HDVnTgIcqlWlZxvcJzWsMjxNPChGLf" entries="6" cols="3"]
```
Max specifies the max number of videos to display, and cols specifies the number of columns to display. If nothing is specified for cols then the table will default to 3 columns.
## License
This project is available under the MIT license. See LICENSE.txt for more information.