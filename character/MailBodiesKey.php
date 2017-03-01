<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:18
 */

namespace EveXMLAPI\Character;

class MailBodiesKey extends CharacterKey
{
    private $ids;

    public function __construct($keyID, $vCode, $characterID, $ids)
    {
        $this->ids = $ids;
        parent::__construct($keyID, $vCode, $characterID);
    }

    public function __toString()
    {
        return '?' . http_build_query([
            'keyID'         => $this->keyID,
            'vCode'         => $this->vCode,
            'characterID'   => $this->characterID,
            'IDs'           => implode(',', $this->ids)
        ]);
    }
}
