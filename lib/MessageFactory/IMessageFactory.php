<?php
/**
 * IMessageFactory.php
 *
 * @package axiles89\profiler\MessageFactory
 * @date: 23.09.2015 22:53
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\MessageFactory;


/**
 * Interface IMessageFactory
 * @package axiles89\profiler\MessageFactory
 */
interface IMessageFactory
{
    /**
     * @param $message
     * @return mixed
     */
    public function createMessage($message);
}