<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 12:44
 */
namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\Type;

class ContractItems extends Request implements Simulatable
{
    public $url = '/char/ContractItems.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $item) {
                $this->list[] = new Type(
                    $item,
                    ['included, singleton, quantity, typeID, recordID' => 'int']
                );
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset columns="recordID,typeID,quantity,rawQuantity,singleton,included" key="recordID" name="itemList">
        <row included="1" singleton="0" quantity="1" typeID="4310" recordID="1737516979"/>
        <row included="1" singleton="0" quantity="1" typeID="35659" recordID="1737516980"/>
        <row included="1" singleton="0" quantity="1" typeID="519" recordID="1737516981"/>
        <row included="1" singleton="0" quantity="2" typeID="28999" recordID="1737516982"/>
        <row included="1" singleton="0" quantity="1" typeID="2961" recordID="1737516983"/>
        <row included="1" singleton="0" quantity="1" typeID="2048" recordID="1737516984"/>
        <row included="1" singleton="0" quantity="2" typeID="29001" recordID="1737516985"/>
        <row included="1" singleton="0" quantity="1" typeID="2961" recordID="1737516986"/>
        <row included="1" singleton="0" quantity="2000" typeID="21894" recordID="1737516987"/>
        <row included="1" singleton="0" quantity="1" typeID="2961" recordID="1737516988"/>
        <row included="1" singleton="0" quantity="1" typeID="1952" recordID="1737516989"/>
        <row included="1" singleton="0" quantity="1" typeID="29009" recordID="1737516990"/>
        <row included="1" singleton="0" quantity="1" typeID="2961" recordID="1737516991"/>
        <row included="1" singleton="0" quantity="1" typeID="1978" recordID="1737516992"/>
        <row included="1" singleton="0" quantity="1" typeID="29011" recordID="1737516993"/>
        <row included="1" singleton="0" quantity="1" typeID="9491" recordID="1737516994"/>
        <row included="1" singleton="0" quantity="1" typeID="1978" recordID="1737516995"/>
        <row included="1" singleton="0" quantity="1" typeID="9491" recordID="1737516996"/>
        <row included="1" singleton="0" quantity="1" typeID="2605" recordID="1737516997"/>
        <row included="1" singleton="0" quantity="1" typeID="2961" recordID="1737516998"/>
        <row included="1" singleton="0" quantity="1" typeID="9491" recordID="1737516999"/>
        <row included="1" singleton="0" quantity="1" typeID="31360" recordID="1737517000"/>
        <row included="1" singleton="0" quantity="1" typeID="8529" recordID="1737517001"/>
        <row included="1" singleton="0" quantity="1" typeID="519" recordID="1737517002"/>
        <row included="1" singleton="0" quantity="1" typeID="31360" recordID="1737517003"/>
        <row included="1" singleton="0" quantity="1" typeID="31113" recordID="1737517004"/>
    </rowset>
</result>
</xml>
XML;
    }
}
