# Wordpress functions:
note: your can replace the app_ with your theme extension

These functions are commonly used functions used for every custom theme.
Use and contribute !!

1. app_update_post_urls() - Update Post URLs 
   This must be used when you want to update the site URLs once gone on production

2. app_setup() - App setup.
   Set up theme defaults and registers support for various WordPress features.
   Note that this function is the proper hook to use when enqueuing items 
   that are meant to appear on the front end. Despite the name, it is used for enqueuing both scripts and styles.

3. app_scripts() - App Scriprs
   Set up theme scripts and styles 
   Note that this function is hooked into the wp_enqueue_scripts hook, which
   runs before the init hook. The init hook is too late for some features, such
   as indicating support post thumbnails.

4. app_wp_title() -  Wordpress Custom Title
   Create a nicely formatted and more specific title element text for output
   in head of document, based on current view.

5. app_site_favicon() - Custom Favicon

6. app_admin_favicon() - Custom Admin Favicon

7. app_custom_admin_footer() - Customize admin footer text

8. app_performance() - Displays the no.of mysql queries and its performance
   This will show the Mysql Stat and memory info. in HTML Comments only in Admin loggedin

9. app_google_analytics() - Add Google Analytics Tracking Code at footer

10. app_get_real_ip_address() - Gets the user's real IP address

11. app_custom_admin_logo() - Set Custom Logo via CSS

12. app_custom_login_logo() - Set Custom Logo in login page via CSS

13. app_login_logo_url_title() - Set Custom Url Title in login page

14. app_custom_gravatar() - Replace Default Gravatar with Custom Image

15. app_featured_image_theme_support() - Adding Featured Image Support to Your Theme

16. register_nav_menus() - This theme uses wp_nav_menu() in one location.

17. app_widgets_init() - Register widgetized area and update sidebar with default widgets.

18. app_excerpt_more() - Custom Excerpt Ending


To contribute please DM on @austinnoronha
