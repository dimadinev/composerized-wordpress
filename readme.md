# Composerized WordPress

This is an experiment in managing a complete WordPress install using [Composer](https://getcomposer.org/).

WordPress itself is pulled from the official download site, and installed to its own subdirectory. Plugins and themes are installed using [WordPress Packagist](https://wpackagist.org/). Any plugins or themes not in the .org repo can be installed using [custom repositories](https://getcomposer.org/doc/05-repositories.md).

### Usage

1. Clone the repo, and configure your web server's webroot to point to the `/public/` directory.
2. Add database credentials, salts, and any custom wp-config directives to `/wp-local-config.php`.
3. Run `composer install` to get everything up and running.
4. Start developing in `public/wp-content/plugins` and/or `/public/wp-content/themes/`.

To upgrade WordPress Core or a plugin, simply update their version number(s) in `composer.json` and run `composer update`.
