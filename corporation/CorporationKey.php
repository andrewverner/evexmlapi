<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 23:26
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Core\Key;

class CorporationKey extends Key
{
    private $corporationID;

    public function __construct($keyID, $vCode, $corporationID)
    {
        parent::__construct($keyID, $vCode);
        $this->corporationID = $corporationID;
    }
}
