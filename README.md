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
---
### ToDo
 - Create mapping system for loading scripts / styles
     - Add async support to script queue
     - Add SRI attribute support to script queue
 - Redo nav and change from hardcoded to more dynamic based on native WP menu
     - Optionally, integrate Materialize walker version
 - Add Gutenberg support (color palettes, blocks, etc.)