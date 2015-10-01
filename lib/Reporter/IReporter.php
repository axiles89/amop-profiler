<?php
/**
 * IReporter.php
 *
 * @package axiles89\profiler\Reporter
 * @date: 24.09.2015 19:01
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Reporter;


/**
 * Interface IReporter
 * @package axiles89\profiler\Reporter
 */
interface IReporter
{
    /**
     * @param $_message
     * @return mixed
     */
    public function sendReport($_message);
}