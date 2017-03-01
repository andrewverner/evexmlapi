<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:08
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;

class ContractKey extends CharacterKey
{
    public $contractID;

    public function __construct($keyID, $vCode, $characterID, $contractID)
    {
        $this->contractID = $contractID;
        parent::__construct($keyID, $vCode, $characterID);
    }

    public function __toString()
    {
        return '?' . http_build_query([
                'keyID'         => $this->keyID,
                'vCode'         => $this->vCode,
                'characterID'   => $this->characterID
            ]);
    }
}
