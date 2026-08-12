# Changelog
The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Notes
- [:ledger: View file changes][Unreleased]
### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security

## [v3.3.0] - 2026-08-12
### Added
- Enqueued JavaScript asset files dynamically based on post type.
- Added `Logger` class to log errors and debug messages.
- Added an example method on how to sanitize/validate settings fields.
- Added settings updated notice and `settings_errors()` to settings wrapper view.
- Added `resize: both;` CSS rule to textareas in settings.
- Handled possible initialization errors.
- Added PHPDoc to most of the classes.
### Changed
- Refactored `public.js` file to use object literal syntax.
- Improved `NoticeManager` class.
- Changed return type of settings callback in `Base.php` class to `void`.
- Renamed `Post` service class to `Posts`.
- Updated `.gitignore` file to ignore AI related files and folders.
### Fixed
- Added missing method return types.
- Added most of the missing attribute and function parameters type declarations.
- Added missing dependency injections.

## [v3.2.0] - 2026-01-28
### Added
- Added textarea HTML element field (#3).
- Added select HTML element field (#3).
### Fixed
- Fixed `getSettingsValue()` method's return value.
- Fixed a small issue in field callback methods.
### Changed
- Updated copyright year.

## [v3.1.0] - 2026-01-25
### Changed
- Updated/Tidied up `Core` class.
### Removed
- Removed the default submenu with similar name.
### Fixed
- Fixed translations not working.
- Renamed some incorrect constants.
- Fixed initial `null` value for container when activating the plugin.

## [v3.0.0] - 2025-04-28
### Notes
❗ New structure ❗
### Added
- Added a `Container` class.
### Changed
- Used `Container` in all other classes.
### Removed
- Removed `getInstance()` methods and singleton codes.

## [v2.1.0] - 2025-04-09
### Added
- Added `ShortcodeManager` class and improved shortcodes handling.
- Added a simple `NoticeManager` class.
- Added a comment for `$hookSuffix` usage in the `Asset` class.

## [v2.0.0] - 2025-02-08
### Added
- Added `Base` model class and an example model.
- Added an example controller.
- Added an example service class (commented).
- Added some example integration classes (commented).
- Added a new example submenu with custom design.
- Added checkbox settings field.
- Added a sample shortcode.
- Added (commented) filters to edit ACF JSON files' paths.
- Added a (commented) filter to remove the default submenu.
- Added a statement to check for required plugins before executing the core class.
### Changed
- Improved `Model` class.
- Improved `Base` menu class.
- Renamed 'Settings' folder and classes to 'Menus'.
- Added hooks to `validateSettings()` + Improved the method.
### Security
- Added `ABSPATH` check to all view files.

## [v1.1.0] - 2024-09-17
### Added
- Added tabs to settings.
- Added i18n support.
- Added number settings field.
### Changed
- Made settings and menus much more dynamic.
- Made default tab selection more dynamic.

[Unreleased]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v3.3.0...main
[v3.3.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v3.2.0...v3.3.0
[v3.2.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v3.1.0...v3.2.0
[v3.1.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v3.0.0...v3.1.0
[v3.0.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v2.1.0...v3.0.0
[v2.1.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v2.0.0...v2.1.0
[v2.0.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v1.1.0...v2.0.0
[v1.1.0]: https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate/compare/v1.0.0...v1.1.0
