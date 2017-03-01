<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:55
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\WalletTransaction;

class WalletTransactions extends Request implements Simulatable
{
    public $url = '/char/WalletTransactions.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $transaction) {
                $this->list[] = new WalletTransaction(
                    $transaction,
                    [
                        'price' => 'float',
                        'transactionDateTime' => 'date',
                        'typeName, clientName, stationName, transactionType, transactionFor' => 'str',
                        'transactionID, quantity, typeID, clientID, stationID, journalTransactionID, clientTypeID' => 'int'
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
    <rowset name="transactions" key="transactionID" columns="transactionDateTime,transactionID,quantity,typeName,typeID,price,clientID,clientName,stationID,stationName,transactionType,transactionFor,journalTransactionID,clientTypeID">
        <row transactionDateTime="2012-12-09 02:28:42" transactionID="2671179227" quantity="1000" typeName="Morphite" typeID="11399" price="8948.99" clientID="1058094831" clientName="Lucius Millcom" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6673802000" clientTypeID="1377"/>
        <row transactionDateTime="2012-12-09 02:19:22" transactionID="2671172618" quantity="200" typeName="Datacore - Mechanical Engineering" typeID="20424" price="98999.00" clientID="147627949" clientName="Ravenal" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6673771732" clientTypeID="1378"/>
        <row transactionDateTime="2012-12-09 02:19:07" transactionID="2671172459" quantity="85" typeName="Datacore - Electronic Engineering" typeID="20418" price="197800.00" clientID="1055100467" clientName="Potis" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6673771053" clientTypeID="1378"/>
        <row transactionDateTime="2012-12-09 02:18:53" transactionID="2671172316" quantity="115" typeName="Datacore - Electronic Engineering" typeID="20418" price="190000.00" clientID="431652996" clientName="FernLackey" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6673770366" clientTypeID="1377"/>
        <row transactionDateTime="2012-11-24 14:57:05" transactionID="2658450303" quantity="1000" typeName="Morphite" typeID="11399" price="7015.03" clientID="92355891" clientName="Veladra Dawn3" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6615037297" clientTypeID="1378"/>
        <row transactionDateTime="2012-11-24 14:26:21" transactionID="2658427478" quantity="40000" typeName="Fullerides" typeID="16679" price="2259.89" clientID="91840338" clientName="Tyche Chi" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6614929175" clientTypeID="1378"/>
        <row transactionDateTime="2012-11-24 14:25:55" transactionID="2658427144" quantity="50000" typeName="Crystalline Carbonide" typeID="16670" price="195.82" clientID="91840338" clientName="Tyche Chi" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6614926580" clientTypeID="1378"/>
        <row transactionDateTime="2012-11-22 18:55:43" transactionID="2657068085" quantity="200" typeName="Datacore - Mechanical Engineering" typeID="20424" price="98000.00" clientID="92406890" clientName="Hiragama MoriMorituri" stationID="60015140" stationName="Hek VII - Tribal Liberation Force Logistic Support" transactionType="buy" transactionFor="corporation" journalTransactionID="6608436244" clientTypeID="1377"/>
        <row transactionDateTime="2012-11-22 18:55:23" transactionID="2657067843" quantity="200" typeName="Datacore - Electronic Engineering" typeID="20418" price="199999.94" clientID="92428903" clientName="Cico Kain" stationID="60005686" stationName="Hek VIII - Moon 12 - Boundless Creation Factory" transactionType="buy" transactionFor="corporation" journalTransactionID="6608435254" clientTypeID="1377"/>
    </rowset>
</result>
</xml>
XML;
    }
}
