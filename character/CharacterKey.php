<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:08
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;

class CharacterKey extends Key
{
    public $characterID;

    public function __construct($keyID, $vCode, $characterID)
    {
        $this->characterID = $characterID;
        parent::__construct($keyID, $vCode);
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
