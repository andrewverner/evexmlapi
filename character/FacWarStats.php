<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 13:20
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;

class FacWarStats extends Request implements Simulatable
{
    public $url = '/char/FacWarStats.xml.aspx';
    public $factionID;
    public $factionName;
    public $enlisted;
    public $currentRank;
    public $highestRank;
    public $killsYesterday;
    public $killsLastWeek;
    public $killsTotal;
    public $victoryPointsYesterday;
    public $victoryPointsLastWeek;
    public $victoryPointsTotal;

    public function parse($xml)
    {
        $this->factionID = intval($xml->factionID);
        $this->factionName = strval($xml->factionName);
        $this->enlisted = new \DateTime(strval($xml->enlisted));
        $this->currentRank = intval($xml->currentRank);
        $this->highestRank = intval($xml->highestRank);
        $this->killsYesterday = intval($xml->killsYesterday);
        $this->killsLastWeek = intval($xml->killsLastWeek);
        $this->killsTotal = intval($xml->killsTotal);
        $this->victoryPointsYesterday = intval($xml->victoryPointsYesterday);
        $this->victoryPointsLastWeek = intval($xml->victoryPointsLastWeek);
        $this->victoryPointsTotal = intval($xml->victoryPointsTotal);
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <factionID>500001</factionID>
    <factionName>Caldari State</factionName>
    <enlisted>2008-06-10 22:10:00</enlisted>
    <currentRank>4</currentRank>
    <highestRank>4</highestRank>
    <killsYesterday>0</killsYesterday>
    <killsLastWeek>0</killsLastWeek>
    <killsTotal>0</killsTotal>
    <victoryPointsYesterday>0</victoryPointsYesterday>
    <victoryPointsLastWeek>1044</victoryPointsLastWeek>
    <victoryPointsTotal>0</victoryPointsTotal>
</result>
</xml>
XML;
    }
}
