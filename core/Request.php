<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:17
 */

namespace EveXMLAPI\Core;

abstract class Request
{
    protected $key;
    protected $url;

    public function __construct(Key $key = null)
    {
        $this->key = $key;
        $this->send($this->url, $key);
    }

    final private function send($url, Key $key = null)
    {
        $ch = curl_init("https://api.eveonline.com{$url}" . $key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        //print_r(htmlspecialchars($result));
        if (curl_errno($ch)) {
            throw new APIException('An cURL error occurred while sending a request: ' . curl_error($ch));
        } else {
            try {
                $xml = new \SimpleXMLElement($result);
                if (isset($xml->error)) return false; else return $this->parse($xml->result);
            } catch (\Exception $exception) {

            }
        }
    }

    abstract function parse($xml);
}
