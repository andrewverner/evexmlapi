<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:08
 */

namespace EveXMLAPI\Character;

class KillMailsKey extends CharacterKey
{
    public $rowCount;

    public function __construct($keyID, $vCode, $characterID, $rowCount)
    {
        $this->rowCount = $rowCount;
        parent::__construct($keyID, $vCode, $characterID);
    }

    public function __toString()
    {
        return '?' . http_build_query([
                'keyID'         => $this->keyID,
                'vCode'         => $this->vCode,
                'characterID'   => $this->characterID,
                'rowCount'      => $this->rowCount
            ]);
    }
}
