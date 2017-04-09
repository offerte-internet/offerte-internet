=== Offerte Internet ===
Contributors: GioSensation
Tags: Offerte Internet, Informazioni ADSL, WordPress API
Author URI: http://gravida.pro/emanuele-feliziani-web-developer
Plugin URI: https://www.offerteinternet.net
Requires at least: 4.7
Tested up to: 4.7.2
Stable tag: trunk
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds a widget with up-to-date information about current Internet Providers in Italy taken from www.offerteinternet.net. No subscription required. Optional attribution links.

== Description ==
Adds a widget with up-to-date information about current Internet Providers in Italy taken from the site [Offerte Internet](https://www.offerteinternet.net "Offerte Internet ti aiuta a trovare la promozione adsl e fibra ottica più adatta alle tue esigenze.") using the WordPress rest API. No subscription required. Optional attribution links.

You just add the widget to the site and it will display up-to-date information about the number of offers you decide, ordered by rating, including network speed and price.

Great if you have a related website, or a real estate website that wants to provide additional information for home-related services like **phone, ADSL or optic fiber plans**. Any home or business-oriented website can use this to add value for their customers.

Attribution is optional, but welcome. You can enable it in the widget control panel.

Enjoy!

= Tech details =
This plugin uses JavaScript to download updated info from [Offerte Internet](https://www.offerteinternet.net "Offerte Internet ti aiuta a trovare la promozione adsl e fibra ottica più adatta alle tue esigenze."), so if you want this to work you should not `dequeue` the JavaScript file, or it will break the functionality. Yet, this is a very lightweight js script with no dependencies, not even jQuery. It just works.

The only caveat is that it uses JavaScript `promise`s, which are currently supported by all major browsers, but can fail in older ones. I will improve this in a future update by including sensible defaults if JavaScript fails at any point.

The **Offerte Internet** plugin comes with a simple stylesheet that makes sure the information looks good by default. You can override the styles through your own stylesheet.

= Issues & support =
If you see something that's not quite right you can contact me on [Twitter](https://twitter.com/Offerteinternet "Offerte Internet – L'ADSL su Twitter") or [Facebook](https://www.facebook.com/offerteinternet/ "Offerte Internet – L'ADSL su Facebook"). I'll be happy to help with more functionalities and fixes.

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/offerte-internet` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Add the widget to your WordPress in Appearance > Widgets
1. Go with the defaults or configure it to your heart's content: you can decide how many offers to show, the intro text, and whether or not to include links to the offer review on OfferteInternet.net
1. Enjoy


== Frequently Asked Questions ==

= Am I required to include attribution links to your website? =

Not at all. You can opt in to include links to original reviews in the widgets config page under Appearance > Widgets.

= Do you provide updated information? =

Yes, the widget uses the WordPress rest API to retrieve the information on the fly and I will do my best to keep the info on offerteinternet.net updated with all the current offers.

== Screenshots ==
1. The UI of the widget config page under Appearance > Widgets
2. How it shows on the front-end

== Changelog ==

= 1.0.0 =
Initial release. Wooo!

== Upgrade Notice ==
Initial release.