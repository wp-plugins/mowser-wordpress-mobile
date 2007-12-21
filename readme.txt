=== Mowser Wordpress Mobile ===
Contributors: mikerowehl
Tags: mobile, xhtml, cellphone, handset, mowser
Requires at least: 2.0.2
Tested up to: 2.3.1
Stable tag: 1.3

This plugin will detect mobile phones, and redirect to Mowser.com to display a mobile optimized version of the page.

== Description ==

Mowser (http://mowser.com) includes a service that allows publishers to display
their existing web content to user on mobile phones and other handheld 
devices.  This plugin detects when a user is on a mobile phone and 
automatically redirects them to the Mowser optimized version of the page they
were trying to access.

The plugin also adds headers that inform search engines that the Mowser version
of pages should be used for mobile devices, and can be used to insert
information about how to add mobile advertising.  For more information about
the headers that Mowser uses see:

http://pub.mowser.com/wiki/Main/HeadersOverview

== Installation ==

Like most other WordPress plugins, you can install the Mowser plugin by
unpacking the distributed .tar.gz file in the wp-content/plugins directory
of your WordPress installation.  Once unpacked you should see a "Mowser Plugin"
entry in the "Plugins" tab of your administrative interface for WordPress.
You'll need to use the "Activate" link under Plugin Management to start using
the plugin.

As soon as the plugin is active it will start redirecting mobile users to the
Mowser version of your blog.  You can test this on your own phone by entering
the URL for your blog into your mobile browser.  Or if you don't have a phone
that you can test web pages from you can try using the OperaMini Simulator:

http://www.operamini.com/demo/

The Mowser site will detect if you're using Google AdSense on your existing
site and swap to Google AdSense for Mobile automatically.  It also supports
using advertising from AdMob on the mobile pages.

If you would like to add AdMob advertisements to the mobile version of your
pages all you have to do is add your AdMob Site ID on the Mowser Options page
(located under the "Options" tab in the administrative area of your blog).  If
you don't already have an account at AdMob you can register for free at 
http://www.admob.com.  Once you register and create a site you can copy the 
Site ID off the My Sites page and paste it into the field on the Mowser 
settings page.  You blog will now include an extra meta header that tells 
Mowser what Site ID to use.

All the advertising revenue is yours to keep!
