<?php
/**
 * BaseLogger.php
 *
 * @package axiles89\profiler\Logger
 * @date: 22.09.2015 22:36
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Logger;
use axiles89\profiler\MessageFactory\IMessageFactory;


/**
 * Class BaseLogger
 * @package axiles89\profiler\Logger
 */
abstract class BaseLogger implements ILogger
{
    /**
     * Обязательные поля type и message
     * @var array
     */
    protected $_message = [];

    /**
     * Фабрика генерации сообщений
     * @var
     */
    protected $factoryMessage;

    const TYPE_START_PROFILER = 1,
        TYPE_END_PROFILER = 2;

    /**
     * @var array
     */
    protected $_typeList = [
        self::TYPE_START_PROFILER => 'Старт профилирования',
        self::TYPE_END_PROFILER => 'Конец профилирования'
    ];

    /**
     * @return mixed
     */
    public function getFactoryMessage()
    {
        return $this->factoryMessage;
    }

    /**
     * @param mixed $factoryMessage
     */
    public function setFactoryMessage(IMessageFactory $factoryMessage)
    {
        $this->factoryMessage = $factoryMessage;
        return $this;
    }


    /**
     * @return array
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @return array
     */
    public function getTypeList()
    {
        return $this->_typeList;
    }


    /**
     * @param $name
     * @param $type
     * @return mixed
     */
    abstract public function log($name, $type);

    /**
     * @return mixed
     */
    public function createMessage(){
        return $this->getFactoryMessage()->createMessage($this->_message);
    }



}