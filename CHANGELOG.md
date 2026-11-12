# Release Notes for Contact Form Honeypot

## Unreleased

- Contact Form Honeypot now requires Craft CMS 6.0 or later, PHP 8.5 or later, and Contact Form 4.0 or later, and runs natively on Craft 6 without the `craftcms/yii2-adapter` package.
- The plugin’s classes have moved to the `CraftCms\ContactForm\Honeypot` namespace.
- The Honeypot Form Param setting can now be overridden from `config/craft/contact-form-honeypot.php`.
- Honeypot values containing only whitespace are no longer treated as spam.
- Added Arabic, Dutch, French, German, Italian, and Spanish translations.

## 2.2.1 - 2026-11-10

- Contact Form Honeypot now suggests the `craftcms/yii2-adapter` package, which is required on Craft 6.

## 2.2.0 - 2026-11-10

- Added Craft 6 compatibility, when the `craftcms/yii2-adapter` package is installed.

## 2.1.0 - 2024-03-19

- Added Craft 5 compatibility.

## 2.0.0 -2022-05-03

### Added
- Added Craft 4 compatibility.

## 1.0.3 - 2022-05-03

### Fixed
- Fixed a PHP error that occurred if Contact Form wasn’t Composer-installed.

## 1.0.2 - 2017-12-04

### Changed
- Loosened the Craft CMS version requirement to allow any 3.x version.

## 1.0.1 - 2017-07-07

### Changed
- Craft 3 Beta 20 compatibility.

## 1.0.0 - 2017-05-16

- Initial release
