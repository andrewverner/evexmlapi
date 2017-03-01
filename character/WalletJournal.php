<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:43
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\WalletJournalRecord;

class WalletJournal extends Request implements Simulatable
{
    public $url = '/char/WalletJournal.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $record) {
                $this->list[] = new WalletJournalRecord(
                    $record,
                    [
                        'date' => 'date',
                        'amount, balance, taxAmount' => 'float',
                        'ownerName1, ownerName2, argName1, reason' => 'str',
                        'refID, refTypeID, ownerID1, ownerID2, argID1, taxReceiverID' => 'int'
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
    <rowset name="transactions" key="refID" columns="date,refID,refTypeID,ownerName1,ownerID1,ownerName2,ownerID2,argName1,argID1,amount,balance,reason,taxReceiverID,taxAmount">
        <row date="2012-12-16 14:47:03" refID="6709813912" refTypeID="15" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="Wiyrkomi Corporation" ownerID2="1000011" argName1="EVE System" argID1="1" amount="-9250.00" balance="385574791.30" reason="" taxReceiverID="" taxAmount="" />
        <row date="2012-12-15 18:53:29" refID="6705533817" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk VI" argID1="40215551" amount="-206000.00" balance="385584041.30" reason="Export Duty for Vorsk VI" taxReceiverID="" taxAmount="" />
        <row date="2012-12-15 18:53:05" refID="6705532062" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk III" argID1="40215546" amount="-254000.00" balance="385790041.30" reason="Export Duty for Vorsk III" taxReceiverID="" taxAmount="" />
        <row date="2012-12-15 18:52:38" refID="6705529857" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk II" argID1="40215545" amount="-160000.00" balance="386044041.30" reason="Export Duty for Vorsk II" taxReceiverID="" taxAmount="" />
        <row date="2012-12-15 18:51:50" refID="6705526089" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk I" argID1="40215544" amount="-183000.00" balance="386204041.30" reason="Export Duty for Vorsk I" taxReceiverID="" taxAmount="" />
        <row date="2012-12-13 10:37:13" refID="6694409579" refTypeID="15" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="Wiyrkomi Corporation" ownerID2="1000011" argName1="EVE System" argID1="1" amount="-21275.00" balance="386387041.30" reason="" taxReceiverID="" taxAmount="" />
        <row date="2012-12-13 01:02:16" refID="6692943658" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk VI" argID1="40215551" amount="-259000.00" balance="386408316.30" reason="Export Duty for Vorsk VI" taxReceiverID="" taxAmount="" />
        <row date="2012-12-13 01:01:32" refID="6692941689" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk III" argID1="40215546" amount="-317000.00" balance="386667316.30" reason="Export Duty for Vorsk III" taxReceiverID="" taxAmount="" />
        <row date="2012-12-13 01:01:24" refID="6692941373" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk II" argID1="40215545" amount="-171000.00" balance="386984316.30" reason="Export Duty for Vorsk II" taxReceiverID="" taxAmount="" />
        <row date="2012-12-13 01:00:37" refID="6692939153" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk I" argID1="40215544" amount="-248000.00" balance="387155316.30" reason="Export Duty for Vorsk I" taxReceiverID="" taxAmount="" />
        <row date="2012-11-22 12:49:07" refID="6607375119" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk II" argID1="40215545" amount="-213000.00" balance="446826716.30" reason="Export Duty for Vorsk II" taxReceiverID="" taxAmount="" />
        <row date="2012-11-22 12:48:59" refID="6607374952" refTypeID="97" ownerName1="reygar burnt" ownerID1="1801683792" ownerName2="CONCORD" ownerID2="1000125" argName1="Vorsk I" argID1="40215544" amount="-228000.00" balance="447039716.30" reason="Export Duty for Vorsk I" taxReceiverID="" taxAmount="" />
    </rowset>
</result>
</xml>
XML;
    }
}
