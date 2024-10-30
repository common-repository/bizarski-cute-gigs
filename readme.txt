=== Bizarski Cute Gigs ===
Contributors: sparxdragon
Donate link: http://cuteplugins.com
Tags: gigs, events, concerts, upcoming, past, posters, band, musician, artist
Requires at least: 3.3
Tested up to: 3.4
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An elegant way for artists to showcase their concerts, shows, and gigs. 

== Description ==

A simple plugin for musicians to show off their gigs in an elegant way. Perfect for rock bands. You can display upcoming and past events in a page or a post, using shortcodes. Upcoming events can also be displayed in a widget. Each gig can have its own poster and links. When the poster thumbnail is clicked, the full-size image is displayed in a Fancybox window (jQuery). Size of thumbnails is customizable. 

* [Docs](http://cuteplugins.com/wordpress-cute-gigs/)
* [Demo](http://cuteplugins.com/cute-gigs-demo/)

= Bizarski Cute Gigs Plugin - Features =

This is a list of the main features that this plugin has. For feature suggestions, feel free to contact Bizarski. 

*Manage Gigs*

* Easily upload a gig poster. The image will be automatically resized and cropped. 
* Add information about a gig: date, location, start time, price, other artists. 
* Add up to three buttons with customizable text and links. 

*Display Gigs*

* Display a list of upcoming gigs inside a page or a post. 
* Display a list of past gigs inside a page or a post. 
* Limit and offset the list of events for pagination.
* Display the poster of the earliest upcoming gig inside a widget. 

== Installation ==

1. Download, install, and activate the Bizarski Cute Gigs plugin.
2. From your Wordpress Dashboard, go to Cute Gigs > Manage Gigs > New Gig > Follow the on-screen cues.
3. Go to a post/page, and enter one of the shortcodes to display a list of upcoming or past gigs. 

For more details, you can also have a look at the [plugin homepage](http://cuteplugins.com/wordpress-cute-gigs/).

== Screenshots ==

1. screenshot-1.jpg - Front end view with custom style
2. screenshot-2.jpg - Adding a new gig from the back end

== Shortcodes ==

The Bizarski Cute Gigs plugin currently has 2 shortcodes. 

* *Display a list of all upcoming gigs: [cutegigs_upcoming_gigs]*
* *Display a list of all past gigs: [cutegigs_past_gigs]*
* *Display 5 past gigs after skipping 10: [cutegigs_past_gigs limit=5 offset=10]*
* *Display 10 past gigs with hidden buttons: [cutegigs_past_gigs limit=10 hide_buttons=1]*

== Changelog == 

= 1.2.0 =
* Bugfix: Fixed incompatibility issues with Wordpress 3.5.

= 1.1.5 =
* NEW: Added choice between opening links in new window, or same window.

= 1.1.0 =
* NEW: Added support for up to three buttons per gig.
* Changed: Moved file storage to Wordpress's "upload" folder. 

== Known issues ==

* Sometimes the Fancybox window appears behind the website menu. To fix this issue, go to your theme's CSS file and look for z-index rules that have a value higher than 1100. Change their value to 1099 and save the file.
* The plugin "Google Analytics for WordPress by Yoast" causes Fancybox to misbehave.
* All versions below 1.2.0 will cause issues in the Dashboard of Wordpress 3.5 and above.
* Upgrading from version 1.0.0 to any newer version will delete all uploaded posters.