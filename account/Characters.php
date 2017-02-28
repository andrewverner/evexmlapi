<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 15:03
 */

namespace EveXMLAPI\Account;

use EveXMLAPI\Character\Character;
use EveXMLAPI\Core\Request;

class Characters extends Request
{
    public $characters = [];

    public $url = '/account/Characters.xml.aspx';

    public function parse($xml)
    {
        foreach ($xml->rowset->row as $character) {
            $this->characters[] = new Character($this->key, intval($character['characterID']), [
                'name'              => strval($character['name']),
                'corporationName'   => strval($character['corporationName']),
                'corporationID'     => intval($character['corporationID']),
                'allianceName'      => strval($character['allianceName']),
                'allianceID'        => intval($character['allianceID']),
                'factionName'       => strval($character['factionName']),
                'factionID'         => intval($character['factionID'])
            ]);
        }
    }
}
