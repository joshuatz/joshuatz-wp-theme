# joshuatzwp / joshuatz-wp
Custom WordPress theme for joshuatz.com

---
## Instructions
### Building
 - Vendored assets are bundled using gulp. `gulp` or `npm run build` should produce the files, which are checked into git, so they can be pre-built for WP.
     - Currently, this is also dependent on the jPrismToolbar submodule already being installed (see below)

### Install
 - There is currently no real setup required other than activating the theme
 - To use jPrismToolbar, currently you need to use the submodule
     - On initial cloning of the whole repo, you after need to run (once):
         - `git submodule init && git submodule update`

### Page Setup
If you want a homepage, and blog page (e.g. `Posts Page`), you can set those up by creating blank pages under `Pages`, and then heading to `Settings -> Reading`, and setting the pages you created as the static pages to display.

> This is also where you can control some related settings, like how many posts show up, per page, on the blog archive / `Posts Page`

The theme has templates to handle both those pages.

You can read detailed instructions on how to do that [here](https://www.wpbeginner.com/wp-tutorials/how-to-create-a-separate-page-for-blog-posts-in-wordpress/).

#### Adding a New Page Template
> 📘 [Docs](https://developer.wordpress.org/themes/template-files-section/page-template-files/)

 - Create page under `/page-templates`
     - Do **not** prefix with `page-`, unless you are trying to match to specific slug
 - Use multi-line comment to specify:
     - `Template Name` and (optionally) `Template Post Type`
     - Good practice: `@file` to explain in detail
 - You can assign the template when editing pages (and posts)

> ⚠ Be very aware of the [WP Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/) and how it can override settings based on filenames

### Optional Settings

 - Optional settings:
     - Theme debug logging
         - Logging will only occur if the log file exists. In theme folder, `touch config/log.txt`. Is gitignored.
     - Theme Settings Page (Dashboard -> Settings -> joshuatz-wp):
         - Google Analytics GA ID - this should be the analytics ID provided by Google Analytics. Should follow format of UA-12345678-01
         - Disqus Custom Subdomain - For if you have Disqus setup and want to enable their comment embed system
     - Custom redirect system
         - You can configure a bunch of pattern based custom redirects with a simple JSON file, rather than having to install a special plugin. Clone jtzwp-custom-redirects.example.json and name as jtzwp-custom-redirects.json and place either in theme directory OR root of WP install - theme will check for both, and take root as preference.
     - Automated post-deployment actions
         - A special URL is available: `{website}/deployment-hook/?deploymentkey={secretKey}`
             - The `secretKey` is autogenerated on theme install, but you can manually change/see it in your WP settings
             - Right now, all this does is sets a deployment timestamp used for "cachebusting" static assets
     - "Under Construction" mode
         - You can easily set the site into under-construction mode, which will redirect all non-wp-admins to /under-construction/ for every single page. You don't have to set up the /under-construction/ page to use this feature. To enable, simply define the UNDER_CONSTRUCTION constant to be true (easiest spot is in your wp-config.php file) like so:
             ````
             define('UNDER_CONSTRUCTION',true);
             ````
             - This should be used with extreme caution, as leaving the site in this mode for an extended length of time can have a negative effect on SEO (not to mention a bad user experience).

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
         -   Make sure that you put this above
         ````
         require_once(ABSPATH . 'wp-settings.php');
         ````
         - I recommend just putting at top of file
     - Here is a pretty good list of optimizations to make from the default config - [link](https://www.labnol.org/internet/wordpress-optimization-guide/3931/)
---
### ToDo
 - Create mapping system for loading scripts / styles
     - Add SRI attribute support to script queue
 - Redo nav and change from hardcoded to more dynamic based on native WP menu
     - Optionally, integrate Materialize walker version
 - Add Gutenberg support (color palettes, blocks, etc.)
 - Add support for the AMP spec version of pages/posts
 - make `/blog` a true theme page, rather than have to manually create it