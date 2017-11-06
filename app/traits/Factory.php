<?php
namespace DS\Traits;

/**
 * Spreadshare
 *
 * Factory trait. Just do "use Factory;" and you're ready to go.
 *
 * @author Dennis Stücken
 * @license proprietary

 * @copyright Spreadshare
 * @link https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Component\Provider
 */
trait Factory
{
    /**
     * Return instance of current class
     *
     * @return static
     */
    final public static function factory()
    {
        $class   = get_called_class();
        $args    = func_get_args();
        $r_class = new \ReflectionClass($class);

        return $r_class->newInstanceArgs($args);
    }
}
