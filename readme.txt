=== Twttr Widget ===
Contributors: bjornjohansen
Donate link: http://www.kiva.org
Tags: twitter, widget, jquery
Author URI: https://bjornjohansen.no/
Requires at least: 3.5
Stable tag: 0.1
Tested up to: 3.8.1
License: GPLv2

Twitter Widget for Embedded Timelines

== Description ==
Twitter Widget for Embedded Timelines. Create one at https://twitter.com/settings/widgets first.

Uses the official HTML widgets from Twitter (https://twitter.com/settings/widgets), but is WordPress-Widgetized and performance optimized, so there's only one script-element which is loaded in page footer, and the external JS is loaded on the window.load event.

== Installation ==
1. Download plugin
2. Upload the plugin through the 'Plugins' > 'Add new' > 'Upload' page in WordPress,
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to https://twitter.com/settings/widgets and create your widget
5. Look at the generated HTML code, find a string that looks like data-widget-id="408156745949642752". That number is your Twitter Widget ID.
6. Edit the widget settings. Make sure you enter your Twitter username and Twitter Widget ID from the previous step

== Screenshots ==

1. Go to https://twitter.com/settings/widgets to create and customize your Twitter Widget. Note the Twitter Widget ID in the HTML code, as you need it later.
2. Configure the WordPress Widget. You need to enter your Twitter username and the Twitter Widget ID.
3. Voila! You have a Twitter Timeline Widget.

== Changelog ==

= Version 0.1 =
* Created 2013-12-04
* User timeline works

