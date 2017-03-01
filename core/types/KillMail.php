<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 14:50
 */

namespace EveXMLAPI\Types;

class KillMail
{
    public $victim;
    public $attackers;
    public $items;

    public function __construct($kill)
    {
        $this->victim = new Victim(
            $kill->victim,
            [
                'characterID, corporationID, allianceID, factionID, damageTaken, shipTypeID' => 'int',
                'characterName, corporationName, allianceName, factionName' => 'str',
                'x, y, z' => 'float'
            ]
        );

        foreach ($kill->rowset as $rowset) {
            switch ($rowset['name']) {
                case 'attackers':
                    $this->attackers = [];
                    foreach ($rowset->row as $attacker) {
                        $this->attackers[] = new Attacker(
                            $attacker,
                            [
                                'characterID, corporationID, allianceID, factionID, damageDone, finalBlow, weaponTypeID, shipTypeID, shipTypeID' => 'int',
                                'characterName, corporationName, allianceName, factionName' => 'str',
                                'securityStatus' => 'float'
                            ]
                        );
                    }
                    break;

                case 'items':
                    $this->items = [];
                    foreach ($rowset->row as $item) {
                        $this->items[] = new Type(
                            $item,
                            ['typeID, flag, qtyDropped, qtyDestroyed, singleton' => 'int']
                        );
                    }
                    break;

                default:
                    break;
            }
        }
    }
}
