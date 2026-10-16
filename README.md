# Government Web Template (GWT) for WordPress

[![Theme version 25.5.0](https://img.shields.io/badge/theme-25.5.0-21759B?logo=wordpress&logoColor=white)](style.css)
[![PHP 8.3+](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/supported-versions.php)
[![MIT license](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/license/mit)
[![Open GitHub issues](https://img.shields.io/github/issues/iGovPhil/gwt-wordpress)](https://github.com/iGovPhil/gwt-wordpress/issues)

GWT is a responsive WordPress theme based on the Unified Web Content Policy draft prepared by PCDSPO, DOST-ASTI, and DOST-ICTO. It is built on the ZURB Foundation framework.

Theme features include responsive layouts, configurable menus and widget areas, a banner slider, Philippine Standard Time and Transparency Seal widgets, and accessibility options.

## Requirements

- A WordPress installation
- PHP 8.3 or newer

## Installation

1. Install the theme by uploading a ZIP from **Appearance > Themes > Add New**, or copy this directory into `wp-content/themes/`.
2. Open **Appearance > Themes** in the WordPress dashboard and activate **GWT-Wordpress**.
3. Configure the theme's menus, widgets, and options in the dashboard.

## Banner Slider

For each slider item, set a full-size featured image, enter its caption in the post title, and put the destination URL in the post content.

## Development

Install the development dependencies with Composer:

```sh
composer install
```

Run the configured WordPress Coding Standards check on a changed PHP file:

```sh
vendor/bin/phpcs path/to/file.php
```

To apply automatic fixes, run PHPCBF and then run PHPCS again:

```sh
vendor/bin/phpcbf path/to/file.php
vendor/bin/phpcs path/to/file.php
```

## Support

Report bugs and request enhancements in the [GitHub issue tracker](https://github.com/iGovPhil/gwt-wordpress/issues).

See [CHANGELOG.md](CHANGELOG.md) for current and historical changes.
