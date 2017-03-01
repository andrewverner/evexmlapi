<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:09
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;

class MailBodies extends Request
{
    public $url = '/char/MailBodies.xml.aspx';
    public $list;

    public function __construct(MailBodiesKey $key)
    {
        parent::__construct($key);
    }

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $message) {
                $this->list[intval($message['messageID'])] = strval($message);
            }
        }
    }
}
