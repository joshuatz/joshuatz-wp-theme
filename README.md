# joshuatzwp / joshuatz-wp
Custom WordPress theme for joshuatz.com
##
---
## Instructions
### Install
 - There is currently no real setup required other than activating the theme
### Optional Settings

 - Optional settings:
     - Theme Settings Page (Dashboard -> Settings -> joshuatz-wp):
         - Google Analytics GA ID - this should be the analytics ID provided by Google Analytics. Should follow format of UA-12345678-01
         - Disqus Custom Subdomain - For if you have Disqus setup and want to enable their comment embed system
     - Custom redirect system
         - You can configure a bunch of pattern based custom redirects with a simple JSON file, rather than having to install a special plugin. Clone jtzwp-custom-redirects.example.json and name as jtzwp-custom-redirects.json and place either in theme directory OR root of WP install - theme will check for both, and take root as preference.
### Recommended plugins and tweaks
 - Recommended Plugins
     - Custom Post Type Permalinks - Highly Recommended for my custom post types - [WP Plugin Page](https://wordpress.org/plugins/custom-post-type-permalinks/)
     - Yoast SEO - [WP Plugin Page](https://wordpress.org/plugins/wordpress-seo/)
     - Advanced Custom Fields - [WP Plugin Page](https://wordpress.org/plugins/advanced-custom-fields/)
 - Recommended core tweaks
     - Dynamically define WP_SITEURL and WP_HOME in wp-config.php - see [this](https://forum.laragon.org/topic/167/tutorial-how-to-force-wordpress-to-use-relative-urls-ngrok)
     - Reduce the number of revisions that wordpress keeps (default is infinity!)
         ````
         define( 'WP_POST_REVISIONS', 3);
         ````
     - Here is a pretty good list of optimizations to make from the default config - [link](https://www.labnol.org/internet/wordpress-optimization-guide/3931/)
---
### ToDo
 - Create mapping system for loading scripts / styles
     - Add async support to script queue
     - Add SRI attribute support to script queue
 - Redo nav and change from hardcoded to more dynamic based on native WP menu
     - Optionally, integrate Materialize walker version
 - Add Gutenberg support (color palettes, blocks, etc.)
 - Add support for the AMP spec version of pages/posts