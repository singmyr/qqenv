<?php
/**
 * User: Mattias Singmyr
 * Date: 05/06/16
 * Time: 20:07
 */

namespace Singmyr;

abstract class QQEnv {
    /**
     * @var
     */
    private static $_ERROR;

    /**
     * @param string $file
     * @return bool
     */
    public static function load($file = '.env') {
        if(!file_exists($file)) {
            static::$_ERROR = $file . ' does not exist.';

            return false;
        }

        $f = fopen($file, 'r');
        if($f === false) {
            static::$_ERROR = 'fopen failed.';

            return false;
        }

        while($line = fgets($f)) {
            putenv($line);
        }

        return true;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public static function get($key, $default = null) {
        return getenv($key) !== false ?: $default;
    }

    /**
     * @return string
     */
    public static function getError() {
        return static::$_ERROR ?? '';
    }
}