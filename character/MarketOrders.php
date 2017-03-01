<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:33
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\MarketOrder;

class MarketOrders extends Request implements Simulatable
{
    public $url = '/char/MarketOrders.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $order) {
                $this->list[] = new MarketOrder(
                    $order,
                    [
                        'orderID, charID, stationID, volEntered, volRemaining, minVolume, orderState, typeID, range, accountKey, duration' => 'int',
                        'escrow, price' => 'float',
                        'bid' => 'bool',
                        'issued' => 'date'
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
    <rowset name="orders" key="orderID" columns="orderID,charID,stationID,volEntered,volRemaining,minVolume,orderState,typeID,range,accountKey,duration,escrow,price,bid,issued">
        <row orderID="4053334100" charID="1801683792" stationID="60005686" volEntered="340000" volRemaining="245705" minVolume="1" orderState="0" typeID="24488" range="32767" accountKey="1000" duration="90" escrow="0.00" price="92.00" bid="0" issued="2015-05-19 03:16:16"/>
        <row orderID="4097983513" charID="1801683792" stationID="60005686" volEntered="390" volRemaining="336" minVolume="1" orderState="0" typeID="3568" range="32767" accountKey="1000" duration="14" escrow="0.00" price="480000.00" bid="0" issued="2015-05-20 03:40:06"/>
        <row orderID="4111136138" charID="1801683792" stationID="60005701" volEntered="27" volRemaining="0" minVolume="1" orderState="2" typeID="20417" range="-1" accountKey="1000" duration="0" escrow="0.00" price="122000.00" bid="1" issued="2015-05-16 04:16:28"/>
        <row orderID="4111136288" charID="1801683792" stationID="60007294" volEntered="79" volRemaining="0" minVolume="1" orderState="2" typeID="20417" range="-1" accountKey="1000" duration="0" escrow="0.00" price="130000.00" bid="1" issued="2015-05-16 04:16:37"/>
    </rowset>
</result>
</xml>
XML;
    }
}
