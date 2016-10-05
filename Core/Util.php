<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * Trait Util, code fragment of project Willer Framework
 * @package Core
 */
trait Util {
	/**
	 * @param $input
	 * @param $key
	 * @param null $default
	 * @return mixed|null
     */
	public static function get($input, $key, $default = null) {
		if (!is_array($input) && !(is_object($input))) {
			return $default;
		}

		if (is_array($input)) {
			return isset($input[$key]) ? !empty($input[$key]) ? $input[$key] : $default : $default;

		} else if (is_object($input)) {
			return isset($input->$key) ? !empty($input->$key) ? $input->$key : $default : $default;
		}
	}
}
