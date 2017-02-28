<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:03
 */

namespace EveXMLAPI;

use EveXMLAPI\Account\Account;
use EveXMLAPI\Character\Character;
use EveXMLAPI\Core\Key;

class API
{
    public $logger;

    public function account($keyID, $vCode)
    {
        return new Account($keyID, $vCode);
    }

    public function character($keyID, $vCode, $characterID)
    {
        return new Character(new Key($keyID, $vCode), $characterID);
    }
}
