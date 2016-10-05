<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * Class WException, code fragment of project Willer Framework
 * @package Core\Exception
 * @extends \Exception
 */
class WException extends Exception {
	/**
	 * WException constructor.
	 * @param null $name
	 * @param null $code
	 * @param null $previous
     */
	public function __construct($name = null, $code = null, $previous = null) {
        parent::__construct($name,$code,$previous);
    }
}
