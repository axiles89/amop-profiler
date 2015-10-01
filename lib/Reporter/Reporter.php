<?php
/**
 * Reporter.php
 *
 * @package axiles89\profiler\Reporter
 * @date: 24.09.2015 19:05
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Reporter;

use axiles89\profiler\Reporter\Sender\CurlSender as CurlSender;
use axiles89\profiler\Reporter\Sender\ISender;

/**
 * Класс для отправки сообщений
 * Class Reporter
 * @package axiles89\profiler\Reporter
 */
class Reporter implements IReporter
{
    protected $_adapter,
              $_host,
              $_projectId,
              $_projectKey;

    /**
     * @param $projectId
     * @param $projectKey
     * @param string $host
     */
    public function __construct($projectId, $projectKey, $host = '192.168.68.130')
    {
        $this->_host = $this->prepareUrl($host);
        $this->_projectId = $projectId;
        $this->_projectKey = $projectKey;
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        if (!isset($this->_adapter)) {
            $this->_adapter = new CurlSender();
        }
        return $this->_adapter;
    }

    /**
     * @param mixed $adapter
     */
    public function setAdapter(ISender $adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }


    /**
     * @param $host
     * @return string
     */
    protected function prepareUrl($host) {
        $hostUrl = parse_url($host);

        $url = (isset($hostUrl['scheme']) ? $hostUrl['scheme'] : 'http') . '://';
        $url .= $hostUrl['host'] . (isset($hostUrl['port']) ? ':' . $hostUrl['port'] : '');
        $url .= '/api/profiler/add';
        return $url;
    }

    /**
     * @param $key
     * @return string
     */
    protected function generateSecretKey($key) {
        return md5($key);
    }

    /**
     * @param $message
     * @return string
     */
    protected function prepareMessage($message) {
        $data = [
            'projectKey' => $this->_projectKey,
            'projectId' => $this->_projectId,
            'dateCreate' => date('d.m.Y H:i:s'),
            'secretKey' => $this->generateSecretKey($this->_projectId.'-'.$this->_projectKey),
            'data' => $message
        ];

        return json_encode($data);
    }


    /**
     * @param $message
     */
    public function sendReport($message) {

        $data = $this->prepareMessage($message);
        $result = $this->getAdapter()->post($this->_host, $data);
    }

}