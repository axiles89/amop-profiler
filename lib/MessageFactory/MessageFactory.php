<?php
/**
 * MessageFactory.php
 *
 * @package axiles89\profiler\MessageFactory
 * @date: 23.09.2015 20:14
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\MessageFactory;


use axiles89\profiler\Logger\BaseLogger;

/**
 * Фабрика для генерации простых сообщений
 * Class MessageFactory
 * @package axiles89\profiler\MessageFactory
 */
class MessageFactory implements IMessageFactory
{
    const TYPE_LIGHT_MESSAGE = 1;

    /**
     * @param $message
     */
    public function createMessage($message) {

        $stack = [];
        $profiler = [];

        foreach ($message as $value) {

            if (!isset($value['message']) and !isset($value['type'])) {
                continue;
            }

            if (isset($value['type']) and $value['type'] == BaseLogger::TYPE_START_PROFILER) {
                $stack[] = $value;
            } elseif ($value['type'] == BaseLogger::TYPE_END_PROFILER and ($last = array_pop($stack)) != null and $last['message'] == $value['message']) {
                $profiler[] = [
                    'type' => self::TYPE_LIGHT_MESSAGE,
                    'message' => $value['message'],
                    'duration' => (int)($value['time'] - (int)$last['time']),
                    'time_start' => (int)$last['time'],
                    'time_end' => (int)$value['time']
                ];
            }
        }

        return $profiler;

    }

}