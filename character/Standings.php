<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:31
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\Standing;

class Standings extends Request
{
    public $url = '/char/Standings.xml.aspx';
    public $agents;
    public $NPCCorporations;
    public $factions;

    public function parse($xml)
    {
        foreach ($xml->characterNPCStandings->rowset as $rowset) {
            if (!empty($rowset)) {
                $group = strval($rowset['name']);
                $this->{$group} = [];
                foreach ($rowset->row as $standing) {
                    $this->{$group}[] = new Standing(
                        $standing,
                        ['fromID' => 'int', 'fromName' => 'str', 'standing' => 'float']
                    );
                }
            }
        }
    }
}
