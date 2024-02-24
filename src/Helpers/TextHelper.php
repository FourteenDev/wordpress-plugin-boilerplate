<?php

namespace WordPressBoilerplatePlugin\Helpers;

/**
 * This is an example helper class as a showcase.
 *
 * You call these methods in other classes of the plugin (or anywhere else in WordPress), like this:
 * `\WordPressBoilerplatePlugin\Helpers\TextHelper::replaceEnglishDigits('123');`
 */
class TextHelper
{
	/**
	 * Replaces English digits with equivalent Persian ones.
	 *
	 * @param	string	$input		Input string.
	 *
	 * @return	string	$output		String with Persian digits.
	 */
	public static function replaceEnglishDigits($input)
	{
		$output = str_replace('0', '۰', $input);
		$output = str_replace('1', '۱', $output);
		$output = str_replace('2', '۲', $output);
		$output = str_replace('3', '۳', $output);
		$output = str_replace('4', '۴', $output);
		$output = str_replace('5', '۵', $output);
		$output = str_replace('6', '۶', $output);
		$output = str_replace('7', '۷', $output);
		$output = str_replace('8', '۸', $output);
		$output = str_replace('9', '۹', $output);

		return $output;
	}
}
