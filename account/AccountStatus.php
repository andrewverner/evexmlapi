<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:13
 */

namespace EveXMLAPI\Account;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;

class AccountStatus extends Request
{
    public $paidUntil;
    public $createDate;
    public $logonCount;
    public $logonMinutes;

    public $url = '/account/AccountStatus.xml.aspx';

    public function parse($xml)
    {
        $this->paidUntil = new \DateTime($xml->paidUntil);
        $this->createDate = new \DateTime($xml->createDate);
        $this->logonCount = intval($xml->logonCount);
        $this->logonMinutes = intval($xml->logonMinutes);
        return $this;
    }
}
