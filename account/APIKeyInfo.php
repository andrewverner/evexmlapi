<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 14:52
 */

namespace EveXMLAPI\Account;

use EveXMLAPI\Core\Request;

class APIKeyInfo extends Request
{
    public $accessMask;
    public $expires;

    public $url = '/account/APIKeyInfo.xml.aspx';

    public function parse($xml)
    {
        $this->accessMask = intval($xml->key['accessMask']);
        $this->expires = (strval($xml->key['expires'])) ? new \DateTime(strval($xml->key['expires'])) : false;
        return $this;
    }
}
