<?php
/**
 * Profiler.php
 *
 * @package axiles89\profiler
 * @date: 22.09.2015 20:44
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler;
use axiles89\profiler\Logger\BaseLogger;
use axiles89\profiler\Logger\Logger;


/**
 * Класс профайлер для системы Amop
 * Class Profiler
 * @package axiles89\profiler
 */
class Profiler
{

    private static $_logger;

    public static function getLogger()
    {
        if (self::$_logger !== null) {
            return self::$_logger;
        } else {
            return self::$_logger = new Logger();
        }
    }

    public static function setLogger(BaseLogger $logger)
    {
        self::$_logger = $logger;
    }

    public static function startProfiler($name) {
        self::getLogger()->log($name, BaseLogger::TYPE_START_PROFILER);
    }

    public static function endProfiler($name) {
        self::getLogger()->log($name, BaseLogger::TYPE_END_PROFILER);
    }

}