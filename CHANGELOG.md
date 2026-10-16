# Changelog

Notable changes to this project are documented here in reverse chronological order. Release dates use ISO 8601 format.

## [25.5.2] - 2026-10-16

### Fixed

- Fixed `js/theme.js` using `$` outside the jQuery wrapper, which stopped Foundation from initializing under WordPress's no-conflict jQuery.
- Fixed the home page banner slider not displaying: removed theme CSS that collapsed the Orbit container, set `loading="eager"` on slide images, marked only the first slide active, and corrected the slider markup (controls and bullets structure, stray closing tag).
- Fixed slider navigation: Orbit now runs with `useMUI:false` because the theme has no Motion UI CSS and transitions never completed.
- Fixed the fixed top bar floating below the page top by adding `top: 0` to `#main-nav`.

### Development

- Applied automatic WordPress Coding Standards fixes (mainly line endings) across the theme PHP files.
- Remaining PHP_CodeSniffer findings are in `inc/vendors/envato-flex-slider/` and need logic changes.

## [25.5.1] - 2026-10-16

### Added

- Replaced the classic Philippine Standard Time and Transparency Seal widgets with block-based widgets, and added migration for existing widget placements.
- Added a browser-local Asia/Manila clock fallback when the official PST service is unavailable.

### Compatibility

- Requires WordPress 6.3 or newer for Block API v3.
## [25.5.0] - 2026-10-16

### Changed

- Updated Foundation to 6.9.0, jQuery to 3.7.1, what-input to 5.2.12, Font Awesome to 4.7.0, FlexSlider to 2.7.2, and ResponsiveSlides to 1.55.
- Switched Foundation to its float-grid build and use WordPress's bundled jQuery.
- Preserve the theme's FlexSlider presentation with overrides for the updated library.
- Use the theme version to invalidate cached theme CSS and JavaScript assets.

## [25.4.0] - 2026-10-16

### Changed

- Refactored theme templates and template tags to improve readability.
- Standardized the names of the script-enqueue and comment-disabling helper files.

### Development

- Added PHP_CodeSniffer configuration and documented the PHP 8.3+ and WordPress Coding Standards expectations.

## 2019-04-04

- Fix conditional display on rightsidebar

## 2019-01-17

- Fix missing jquery file issue causing to disable all scripts within the page

## 2018-12-13

- Fix theme missing color option issue
- Added native style for alignleft alignright classes

## 2018-03-07

- Fix long text wrapping in menu

## 2017-10-03

- Added URL Link support for banner Slider

## 2017-02-23

- Fixed empty menu issue when nothing is assigned
- Added automatic display of auxiliary menu if menu is present, removed theme option selection
- Fixed banner left button bug.

## 2016-07-22

- [Update] Foundation version 6.2.2
- [Features] Philippine Standard Time (PST)
    - Font customization
- [Features] Panel Top & Bottom section
    - Background color customization
- [Enhancement] Orbit Slider
- [Enhancement] Responsive Mobile Menu
- [Enhancement] Transparency Seal
- [Enhancement] Accessibility Add-on
    - High Contrast mode
    - Skip to Content
    - Skip to Footer

## 2016-02-29

- Fixed mega menu structure
- Fixed banner slider full width
- Added feature image on post
- Added default widgets on theme activation
	- transparency seal Logo widget
	- philippine standard time widget
- Added theme customization on template's theme option
    - Masthead logo image with text
        - agency name
        - tagline
        - font color
        - image logo alt text
    - Content panel and sidebar customization
        - border width
        - border color
        - border radius
        - background color
    - Content header font size and rendering
    - Agency Footer's background color customization
- Changed version branding to version 2.0 (Pansit)
- Removed the Accessibility Add-on
    - High Contrast Mode
    - Grayscale Mode
    - Toggle font size

## 2015-09-30

- Fixed Agency Footer extra padding.
- Changed the accessibility widget to right side

## 2015-09-22

- Added new accessibility features:
  - Toggle High contrast mode
  - Toggle Grey scale
  - Popup Accessibility Statement
- Fixed Breadcrumbs '/' after Youre Here:
- Fixed Panel Top extra padding issue.
- Added mega menu feature
- Sticky top menu

## 2015-04-10

- Added drop shadow on drop down menu

## 2015-03-19

- Added breadcrumbs support

## 2015-02-11

- Smaller headings for Agency footer (use h3 tag)
- Smaller headings for Content Post (use h5 tag)
- Smaller headings for widgets
- Bannerd title paddings
- Remove box design on top and bottom panel, added custom class: box-mode
- Smaller headings for Post Navigation (pagination) (use h4)
- Automatic trim of character/word for Post lists
- Responsive Logo Support
- Accessibility shortcut bug fix
- Created an option to automatically trim at specific characters/word for Post lists
- Created an option to remove published date
- Created an option to remove author
- Removed box effect on Author

## 2014-08-07

- Revamped new design
- Added new widget locations (New widget locations banner section 1, banner section 2, ear content 1, ear content 2 not yet usable)
- For banner content, use featured image to upload images, use the content area for linking the image to an external page, use the title for captions

## 2014-03-18

- Full width template functions
- Text decoration for standard footer links
- Slider get functions
