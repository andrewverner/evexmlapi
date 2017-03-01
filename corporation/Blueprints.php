<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 16:48
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\BlueprintType;

class Blueprints extends Request implements Simulatable
{
    public $url = '/corp/Blueprints.xml.aspx';
    public $list = [];
    private $sorter;

    public function __construct(Key $key = null, \Sorter $sorter = null)
    {
        $this->sorter = $sorter;
        parent::__construct($key);
    }

    function parse($xml)
    {
        if (!empty($xml->rowset)) {
            foreach ($xml->rowset->row as $blueprint) {
                $this->list[] = new BlueprintType(
                    $blueprint,
                    [
                        'runs, materialEfficiency, timeEfficiency, quantity, flagID, typeID, locationID, itemID' => 'int',
                        'typeName' => 'str'
                    ]
                );
            }
        }

        if ($this->sorter) {
            $this->list = $this->sorter->sort($this->list);
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset columns="itemID,locationID,typeID,typeName,flagID,quantity,timeEfficiency,materialEfficiency,runs" key="itemID" name="blueprints">
        <row runs="1" materialEfficiency="0" timeEfficiency="0" quantity="-2" flagID="4" typeName="Rattlesnake Victory Edition Blueprint" typeID="34153" locationID="60003466" itemID="1014573377908"/>
        <row runs="10" materialEfficiency="0" timeEfficiency="0" quantity="-2" flagID="4" typeName="Council Diplomatic Shuttle Blueprint" typeID="34497" locationID="60003466" itemID="1012538208557"/>
        <row runs="1" materialEfficiency="0" timeEfficiency="0" quantity="-2" flagID="4" typeName="Victorieux Luxury Yacht Blueprint" typeID="34591" locationID="60003466" itemID="1017147043703"/>
    </rowset>
</result>
</xml>
XML;
    }
}
