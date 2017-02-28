<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 28.02.17
 * Time: 22:31
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;

class ChatChannels extends Request
{
    public $url = '/char/ChatChannels.xml.aspx';

    public function parse($xml)
    {
        
    }
}
