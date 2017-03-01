<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:04
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\PlanetaryColony;

class PlanetaryColonies extends Request implements Simulatable
{
    public $url = '/char/PlanetaryColonies.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $colony) {
                $this->list[] = new PlanetaryColony(
                    $colony,
                    [
                        'solarSystemID, planetID, planetTypeID, ownerID, upgradeLevel, numberOfPins' => 'int',
                        'solarSystemName, planetName, planetTypeName, ownerName' => 'str',
                        'lastUpdate' => 'date'
                    ]
                );
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
  <rowset name="colonies" key="planetID" columns="solarSystemID,solarSystemName,planetID,planetName,planetTypeID,planetTypeName,ownerID,ownerName,lastUpdate,upgradeLevel,numberOfPins">
    <row solarSystemID="30003396" solarSystemName="Maturat" planetID="40215260" planetName="Maturat II" planetTypeID="2015" planetTypeName="Planet (Lava)" ownerID="1801683792" ownerName="reygar burnt" lastUpdate="2015-07-29 02:17:47" upgradeLevel="5" numberOfPins="8" />
    <row solarSystemID="30003399" solarSystemName="Vorsk" planetID="40215544" planetName="Vorsk I" planetTypeID="2063" planetTypeName="Planet (Plasma)" ownerID="1801683792" ownerName="reygar burnt" lastUpdate="2015-07-29 02:16:05" upgradeLevel="4" numberOfPins="7" />
    <row solarSystemID="30003399" solarSystemName="Vorsk" planetID="40215545" planetName="Vorsk II" planetTypeID="2063" planetTypeName="Planet (Plasma)" ownerID="1801683792" ownerName="reygar burnt" lastUpdate="2015-07-29 02:16:18" upgradeLevel="4" numberOfPins="7" />
    <row solarSystemID="30003399" solarSystemName="Vorsk" planetID="40215546" planetName="Vorsk III" planetTypeID="2015" planetTypeName="Planet (Lava)" ownerID="1801683792" ownerName="reygar burnt" lastUpdate="2015-07-29 02:31:16" upgradeLevel="5" numberOfPins="9" />
    <row solarSystemID="30003399" solarSystemName="Vorsk" planetID="40215548" planetName="Vorsk IV" planetTypeID="11" planetTypeName="Planet (Temperate)" ownerID="1801683792" ownerName="reygar burnt" lastUpdate="2015-07-29 02:32:04" upgradeLevel="4" numberOfPins="12" />
    <row solarSystemID="30003399" solarSystemName="Vorsk" planetID="40215551" planetName="Vorsk VI" planetTypeID="13" planetTypeName="Planet (Gas)" ownerID="1801683792" ownerName="reygar burnt" lastUpdate="2015-07-29 02:16:43" upgradeLevel="4" numberOfPins="7" />
  </rowset>
</result>
</xml>
XML;
    }
}
