<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:05
 */

namespace EveXMLAPI\Core;

class Key
{
    public $keyID;
    public $vCode;

    public function __construct($keyID, $vCode)
    {
        $this->keyID = $keyID;
        $this->vCode = $vCode;
    }

    public function __toString()
    {
        return '?' . http_build_query([
            'keyID' => $this->keyID,
            'vCode' => $this->vCode
        ]);
    }
}
