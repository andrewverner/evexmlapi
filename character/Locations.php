<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 15:54
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\Type;

class Locations extends Request implements Simulatable
{
    public $url = '/char/Locations.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $location) {
                $this->list[] = new Type(
                    $location,
                    ['itemID, x, y, z' => 'int', 'itemName' => 'str']
                );
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset name="locations" key="itemID" columns="itemID,itemName,x,y,z">
        <row itemID="1017795212344" itemName="awesome ship" x="0" y="0" z="0"/>
        <row itemID="1017795212345" itemName="my container" x="0" y="0" z="0"/>
    </rowset>
</result>
</xml>
XML;
    }
}
