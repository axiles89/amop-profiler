<?php
/**
 * CurlSender.php
 *
 * @package axiles89\profiler\Reporter\Sender
 * @date: 24.09.2015 19:14
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace axiles89\profiler\Reporter\Sender;


/**
 * Class CurlSender
 * @package axiles89\profiler\Reporter\Sender
 */
class CurlSender implements ISender
{

    /**
     * @var array
     */
    protected $options = array(
        'timeout' => 20,
        'connecttimeout' => 20,
        'useragent' => 'Amop Api',
        'headers' => array(
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json'
        )
    );


    /**
     * @param $url
     * @param $message
     * @return mixed
     * @throws Exception
     */
    public function post($url, $message) {

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $message);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->options['connecttimeout']);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->options['timeout']);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->options['useragent']);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());

        $result = curl_exec($curl);

        echo "<pre>";
        print_r($result);
        echo "</pre>";
        die();
        $info = curl_getinfo($curl);

        if (curl_errno($curl)) {
            throw new Exception('Service ' . $url . ' not available: ' . curl_error($curl) . (isset($info['http_code']) ? "(http-code: {$info['http_code']})" : ''));
        }

        if ($info['http_code'] >= 400) {
            throw new Exception('Service ' . $url . ' not available: ' . (isset($info['http_code']) ? "(http-code: {$info['http_code']}) " : '') . $result);
        }

        curl_close($curl);

        return $result;
    }

    /**
     * @return array
     */
    protected function getHeaders() {
        if (isset($this->options) and is_array($this->options)) {
            $headers = array();
            foreach ($this->options['headers'] as $header => $value) {
                $headers[] = "{$header}: {$value}";
            }
        } else {
            $headers = array(
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json',
                'Connection: Close'
            );
        }

        return $headers;
    }

}