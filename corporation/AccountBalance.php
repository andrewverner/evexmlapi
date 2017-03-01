<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 23:37
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Character\CharacterKey;
use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Types\Type;

class AccountBalance extends Request
{
    public $url = '/corp/AccountBalance.xml.aspx';
    public $list;

    public function __construct(Key $key, $characterID)
    {
        parent::__construct(new CharacterKey($key->keyID, $key->vCode, $characterID));
    }

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $record) {
                $this->list[] = new Type(
                    $record,
                    ['balance' => 'float', 'accountID, accountKey' => 'int']
                );
            }
        }
    }
}
