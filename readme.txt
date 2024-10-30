=== CMSify ===
Contributors: devbit
Donate link: http://devbits.ca/
Tags: cmsify, cms, admin, media, editor
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 1.22

CMSify your WordPress!  Additional options for branding, extended features or hiding unneeded widgets, column and more!

== Description ==

CMSify will take your WordPress to the next level with easy customizations to brand, modify and hide or enable features you may or may not need.  Everything from widgets to notices can be toggled on or off for a customized CMS for use with clients.

**Admin Options**

* Disable Upgrade Notice for Non-Admins
* Disable Individual Dashboard Widgets for all users
* Disable Individual Widgets for all users
* Disable specific Post & Page Management Columns for all users
* Disable Individual Post & Page Editor Meta Boxes for all users

**Media Options**

* Set a Maximum Full Size for your images
* Create your own custom sized images when uploading that can be accessed via WordPress functions.

**Editor Options**

* Set your own editor stylesheet to display your themes styles within the editor
* Set TinyMCE individual format selections such as any h1-6 tag, address, preformatted, div, blockquote, definition term, definition description, code, and code sample
* Set your own TinyMCE custom font sizes

**Branding Options**

* Custom Header Icon
* Custom Footer Credits
* Custom Login Logo

**Recommendations**

* Includes a list of complementary plugins that will help make your CMS environment even more CMSified!

== Installation ==

*Automatic Install*

1. Find this plugin within your WordPress installations `Add Plugin` area
1. Use the automated install feature and then activate

*Manual Install*

1. Unzip cmsify.zip into a `cmsify` folder.
1. Upload the `cmsify` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Locate the *CMSify* panel within *Options*

== Frequently Asked Questions ==

= How do I use custom image sizes? =

You can use access new images within your template files using the function [wp_get_attachment_image_src( $attachment_id, $size, $icon );](http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src) where $size is the custom label you assigned.

== Screenshots ==

1. Admin Options
2. Media Options
3. Editor Options

== Changelog ==
= 1.22 =
* Fix Re-Assign function, fix preview images, add pro preview images

= 1.21 =
* Enabled Pro Options (Admin Notifications, Media Re-assign, Admin Bar Editing)

= 1.0 =
* Plugin is now top-level instead of under the Settings panel
* Moved branding into it's own area instead of under Admin tab
* Added height detection for login logo
* Added ability to hide plugin widgets 

= 0.7 =
* Added Admin branding options - Header Icon, Footer Credits & Login Logo options.

= 0.6 =
* Fixed class location issue for MaxFullSize function
* Added Editor Stylesheet locations options
* Added Footer Credits Editor

= 0.5 =
* Initial release.

== Upgrade Notice ==

= 1.21 =
Media Re-Assignment fixed, Screenshot previews fixed, minor upgrade this time - more features soon!