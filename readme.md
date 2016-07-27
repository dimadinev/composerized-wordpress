# Composerized WordPress

This is an experiment in managing a complete WordPress install using [Composer](https://getcomposer.org/).

WordPress itself is pulled from the official download site using Composer, and installed to its own subdirectory. Although this is a subdirectory install, the rewrite rule below will rewrite requests for WordPress Core files to the `/wordpress` subdirectory seamlessly, so the user does not see `/wordpress/` in admin URLs.

Plugins and themes are installed to a standalone wp-content directory from [WordPress Packagist](https://wpackagist.org/). Any plugins or themes not in the .org repo can be installed using [custom repositories](https://getcomposer.org/doc/05-repositories.md).

Uploads are also stored in the standalone wp-content directory, and are ignored by Git.

### Usage

1. Clone the repo, and configure your web server's webroot to point to the `/public/` directory.
2. Add the rewrite rule below to your Nginx config.
3. Add database credentials, salts, and any custom wp-config directives to `/wp-local-config.php`.
4. Run `composer install` to get everything up and running.
5. Start developing in `public/wp-content/plugins` and/or `/public/wp-content/themes/`.

To upgrade WordPress Core or a plugin, simply update their version number(s) in `composer.json` and run `composer update`.

### Nginx Rewrite Rule

In order to rewrite requests for WordPress core files to the `/wordpress` directory, add this directive to your Nginx config:

```
# Rewrite requests for WordPress core files to the /wordpress directory
rewrite ^/((wp-(admin|includes)/)+(.*))|(license\.txt|readme\.html|wp-[_0-9a-zA-Z-]+\.php|xmlrpc\.php) /wordpress/$1$5;
```

In a production install, these rewrites would probably be better implemented as Nginx location blocks for performance reasons, but this works and is much simpler than doing it with location blocks.

### Caveats

* This setup has not yet been tested with multisite.
* In order to update WordPress, the WordPress version must be updated in three places in `composer.json`. The reason I am not installing WordPress from [johnpbloch/wordpress](https://github.com/johnpbloch/wordpress) is that I did not want the WordPress package in `/wordpress` to include the wp-content directory, since we're using a custom wp-content directory in `/wp-content`. Using a custom repository allows me to pull in the "no-content" ZIP file from the .org servers.
