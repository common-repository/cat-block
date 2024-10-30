=== Cat Block ===
Contributors: cvmh,nicolasrenard
Developer: CVMH solutions (contact@cvmhsolutions.com)
Tags: category, taxonomy, widget
Requires at least: 3.6
Tested up to: 5.9
Stable tag: trunk
License: GPLv2 or later

Adds a block (widget or shortcode), which scrolls through the posts in a category.


== Description ==
Adds a block (widget or shortcode), which scrolls through the posts in a category.

= Current features =
* Easy to use
* Only fade effect
* Customizable
* Shortcode & Widget

= Shortcode =
Use [cvmh-catblock]
If you want to disable a parameter which is on true by default, put an empty string. Example: [cvmh-catblock slideshow=""]

= Shortcode parameters =
* title: widget title (default: Category block)
* introduction: text before posts list (default: empty)
* category: array of category ids to use (default: empty, all categories will be used)
* count: number of psts to display (default: 3, set to -1 if you want all posts)
* buttonall: weither to display a link to the category (default: true, only if category has parameter has only one category id)
* alltext: text of the "all button" (default: See all)
* posttype: post type to get (default: post)
* showimage: weither to display the post thumbnail (default: false)
* imagesize: size of the post thumbnail (default: thumbnail)
* showtitle: weither to display the post title (default: true)
* titletag: html tag for the post title (default: h3)
* titlelength: max length for the post title in caracters (default: 45)
* showexcerpt: weither to display the post excerpt (default: false)
* excerptlength: max length for the excerpt in words (default: 50)
* showdate: weither to display the post date (default: false)
* dateformat: post date format (default: j F Y)
* showreadmore: weither to display a link to the post in addition to the link on the post title (default: true)
* readmoretext: text of the "read more" button (default: Read more)
* readmoretype: html tag for the "read more" button (default: anchor, use "button" if you want a link in javascript)
* slideshow: display posts in a slideshow (default: true)
* duration: duration of a slide in ms (default: 7000)
* shownav: weither to display dots for navigation if slideshow is activated (default: true)


Looking for a WordPress agency? Contact us: [agence web WordPress](http://www.agence-web-cvmh.fr)


== Installation ==
1. Unzip the plugin and upload the "cat-block" folder to your "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" administration page in WordPress
3. Use the shortcode or the widget
4. Enjoy.


== Changelog ==

= 2.6.18 =
* Changed: WordPress tested up version

= 2.6.17 =
* Added: Filter cvmh_catblock_item_class with post ID parameter

= 2.6.16 =
* Fixed: Force balance tags in excerpts

= 2.6.15 =
* Fixed: Excerpt resize

= 2.6.14 =
* Added: Offset parameter
* Changed: tested up version

= 2.6.13 =
* Added: Filters cvmh_catblock_before_img and cvmh_catblock_after_img to wrap image

= 2.6.12 =
* Changed: Widget title is not displayed if empty

= 2.6.11 =
* Fixed: Javascript problem on slide change

= 2.6.10 =
* Added: cvmh_catblock_excerpt_resized_addendum filter

= 2.6.9 =
* Added: widget params in cvmh_cat_block_get_posts_args filter

= 2.6.8 =
* Fixed: admin CSS conflict

= 2.6.7 =
* Added: filter cvmh_catblock_link

= 2.6.6 =
* Added: filter cvmh_catblock_before_title
* Added: filter cvmh_catblock_widget_title_tag
* Added: filter cvmh_catblock_after_widget_title

= 2.6.5 =
* Added: filter cvmh_cat_block_get_posts_args

= 2.6.4 =
* Added: 3 filters (cvmh_catblock_item_title, cvmh_catblock_after_title and cvmh_catblock_after_content)

= 2.6.3 =
* Fixed: text domain

= 2.6.2 =
* Changed: variable type for numbers
* Changed: excerpt function
* Changed: selected method for widget thumbnail select

= 2.6.1 =
* Fixed: replace text domain constant by real string

= 2.6 =
* Fixed: translate path
* Changed: widget name

= 2.5 =
* Added: widget introduction

= 2.4 =
* Fixed: Link to all posts of a category

= 2.3 =
* Added: widget title

= 2.2 =
* Fixed: shortcode default arguments function call
* Changed: tested up version

= 2.1 =
* Changed: tested up version

= 2.0 =
**Warning: this update changes some names in plugin options. Be sure to configure again your widgets and/or shortcodes after update.**

* Changed: aside tag to div in markup to avoid two aside tags
* Added: image size selector in widget configuration
* Added: "Read more" button display selector
* Changed: widget form

= 1.0 =
* Initial Release.


== How to uninstall Cat Block ==
To uninstall Cat Block, you just have to de-activate the plugin from the plugins list.
