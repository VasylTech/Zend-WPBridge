= Zend WordPress Bridge =
============================


Introduction
------------

This is the simple example of WordPress integration with Zend Framework 2 website


Installation
------------

1. Download or clone the project to your local;

2. Create a virtual host that points to the public folder;

3. Run the composer if necessary to download and install Zend Framework;

4. Download the latest WordPress package and move all files to public/wordpress
   folder (you can have a different name of the folder but make sure that
   config/autoload/local.php is adjusted accordingly);

5. Install the WordPress and make sure that you can access the admin side with
   http://your-virtual-host/wordpress/wp-admin URL;

6. Go to WordPress admin side and under the Settings->General, change the
   "Site Address (URL)" to http://your-virtual-host/blog;

7. Go to Settings->Permalink and select "Custom Structure" with "/%postname%" as
   your default blog permalink;

   --- Belove are optional steps ---

8. Open public/wordpress/index.php file and change turn off the theme support:
   define('WP_USE_THEMES', false);

9. Open your public/wordpress/wp-config.php file and add before "That's all, stop editing!"
   define('WP_USE_THEMES', false);

10. Go to browser and navigate to your website. That's it.