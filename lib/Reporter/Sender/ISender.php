<?php
/**
 * ISender.php
 *
 * @package axiles89\profiler\Reporter\Sender
 * @date: 24.09.2015 19:14
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Reporter\Sender;


/**
 * Interface ISender
 * @package axiles89\profiler\Reporter\Sender
 */
interface ISender
{
    /**
     * @param $url
     * @param $message
     * @return mixed
     */
    public function post($url, $message);
}