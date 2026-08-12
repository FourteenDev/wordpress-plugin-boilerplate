# WordPress Plugin Boilerplate

A **scalable and advanced** WordPress plugin boilerplate.

`v3.3.0` ([Changelog](CHANGELOG.md))

## Requirements

- **PHP**: 8.0 or higher
- **WordPress**: 5.0 or higher
- **Composer**: For dependency management

## Installation

Clone or download this repository, and then you'll need to do a four-step **CASE-SENSITIVE** find and replace in all the codes:
1. Search for `WordPressBoilerplatePlugin` to capture the namespaces.
2. Search for `FDWPBP` to capture the constants.
3. Search for `fdwpbp` to capture option name and slugs.
4. Search for `wordpress-boilerplate-plugin` to capture the text domains.

Then, update the header in `plugin.php` with your own information.

## Composer Setup

**AFTER** you have done the find and replace, run this command in the plugin root:
```bash
$ composer install
```

## Translating the Plugin

1. Open terminal in the plugin root, and run this command to generate the POT file with WP-CLI:
```bash
$ wp i18n make-pot . languages/wordpress-boilerplate-plugin.pot
```

2. Create translations with PoEdit:
	- Open PoEdit and choose "Create new translation" or "New from POT file".
	- Select `languages/wordpress-boilerplate-plugin.pot`.
	- Choose your target language locale, for example `de_DE` for German.
	- Translate each string.
	- Save the file as `languages/wordpress-boilerplate-plugin-de_DE.po`.
	- PoEdit will automatically generate `languages/wordpress-boilerplate-plugin-de_DE.mo`.

3. Keep translations up to date:
   - After adding or changing strings, regenerate the POT file.
   - Reopen the updated POT in PoEdit and choose "Update from POT file" to update your translations.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
