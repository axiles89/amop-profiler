<?php
/**
 * ILogger.php
 *
 * @package axiles89\profiler\Logger
 * @date: 22.09.2015 22:33
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Logger;


/**
 * Interface ILogger
 * @package axiles89\profiler\Logger
 */
interface ILogger
{
    /**
     * @param $name
     * @param $type
     * @return mixed
     */
    public function log($name, $type);

    /**
     * @return mixed
     */
    public function createMessage();
}