<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 28.02.17
 * Time: 22:31
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Types\ChatChannel;

class ChatChannels extends Request
{
    public $url = '/char/ChatChannels.xml.aspx';
    public $list = [];

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            foreach ($xml->rowset->row as $chat) {
                $this->list[] = new ChatChannel($chat);
            }
        }
    }
}
