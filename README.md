# GWT WordPress Theme

[![Theme version 25.5.2](https://img.shields.io/badge/theme-25.5.2-21759B?logo=wordpress&logoColor=white)](style.css)
[![WordPress 6.3+](https://img.shields.io/badge/WordPress-6.3%2B-21759B?logo=wordpress&logoColor=white)](https://wordpress.org/download/)
[![PHP 8.3+](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/supported-versions.php)
[![MIT license](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/license/mit)
[![Open GitHub issues](https://img.shields.io/github/issues/lamerock/gwt-wordpress)](https://github.com/lamerock/gwt-wordpress/issues)

GWT (Government Web Template) is a responsive WordPress theme based on the draft Unified Web Content Policy prepared by PCDSPO, DOST-ASTI, and DOST-ICTO. It uses the ZURB Foundation framework.

This repository is an independently maintained fork based on GWT WordPress 25.3.3. It does not track upstream releases; development and support for this fork are managed here.

## Features

- Responsive page layouts with configurable menus, sidebars, footer areas, and homepage banner sections.
- Theme options for agency branding, colors, breadcrumbs, publishing details, and accessibility links and keyboard shortcuts.
- Homepage banner slider with featured images and optional destination links.
- Philippine Standard Time and Transparency Seal blocks for the WordPress block editor.
- The Philippine Standard Time block uses the official synchronized time service when available, with a browser-clock fallback formatted for Asia/Manila.

## Requirements

- WordPress 6.3 or newer.
- PHP 8.3 or newer.

## Installation

1. Upload the theme ZIP under **Appearance > Themes > Add New**, or copy this directory into `wp-content/themes/`.
2. In the dashboard, open **Appearance > Themes** and activate **GWT-Wordpress**.
3. Configure the theme under **Appearance > Theme Options**. Assign menus under **Appearance > Menus** and add blocks or widgets under **Appearance > Widgets**.

## Configuration

### Menus and widget areas

The theme registers Auxiliary Menu, Left Menu Top bar, and Right Menu Top bar locations. Widget areas include left and right sidebars, two homepage banner sections, top and bottom panels, and four agency footer areas. Assign content to the areas you use under **Appearance > Widgets**.

### Homepage slider

Add a slider item from **Slider Images** in the dashboard. Set its featured image, use the post title for the caption, and enter the destination in the slider URL field. Slider items appear on the homepage.

### Editor blocks

Add **Philippine Standard Time** or **Transparency Seal** from the Widgets block inserter. Set the Transparency Seal block's URL to the destination page for the seal.

## Development

Install the development dependencies with Composer:

```sh
composer install
```

Run PHPCS on a changed PHP file. The repository's `phpcs.xml.dist` applies WordPress Coding Standards and PHP compatibility checks, and excludes bundled libraries:

```sh
vendor/bin/phpcs path/to/file.php
```

To apply automatic fixes, run PHPCBF on the file and then run PHPCS again:

```sh
vendor/bin/phpcbf path/to/file.php
vendor/bin/phpcs path/to/file.php
```

On Windows PowerShell, use the batch files in `vendor\bin` (for example, `.\vendor\bin\phpcs.bat path\to\file.php`).

## Support

Report bugs and request enhancements in the [GitHub issue tracker](https://github.com/lamerock/gwt-wordpress/issues). See [CHANGELOG.md](CHANGELOG.md) for release history.
