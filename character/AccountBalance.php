<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 15:24
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;

class AccountBalance extends Request
{
    public $balance;

    public $url = '/char/AccountBalance.xml.aspx';

    public function __construct(Key $key = null)
    {
        parent::__construct($key);
    }

    public function parse($xml)
    {
        $this->balance = intval($xml->rowset->row['balance']);
    }

    public function __toString()
    {
        return number_format($this->balance, 2, '.', ' ') . ' ISK';
    }
}
