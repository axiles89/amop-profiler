<?php
/**
 * Logger.php
 *
 * @package axiles89\profiler\Logger
 * @date: 22.09.2015 21:16
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Logger;
use axiles89\profiler\MessageFactory\MessageFactory;


/**
 * Class Logger
 * @package axiles89\profiler\Logger
 */
class Logger extends BaseLogger
{
    /**
     * Logger constructor.
     */
    public function __construct()
    {
        $this->factoryMessage = new MessageFactory();
    }

    /**
     * @param $name
     * @param $type
     */
    public function log($name, $type) {
        if (!array_key_exists($type, $this->_typeList)) {
            throw new \InvalidArgumentException("Type $type is incorrect");
        }

        $cpu = getrusage();

        $this->_message[] = [
            'type' => $type,
            'message' => $name,
            'time' => microtime(true),
            'memory' => memory_get_usage (true),
            'cpu' => ($cpu['ru_utime.tv_usec'] + $cpu['ru_stime.tv_usec'])
        ];
    }

}