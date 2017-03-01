<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 10:36
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\BidType;

class ContractBids extends Request implements Simulatable
{
    public $url = '/char/ContractBids.xml.aspx';
    public $bids = [];

    function parse($xml)
    {
        if (!empty($xml->rowset)) {
            foreach ($xml->rowset->row as $bid) {
                if (!isset($this->bids[intval($bid['contractID'])])) $this->bids[intval($bid['contractID'])] = [];
                $this->bids[intval($bid['contractID'])][] = new BidType(
                    $bid,
                    [
                        'amount' => 'float',
                        'dateBid' => 'date',
                        'bidderID, contractID, bidID' => 'int'
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
        <rowset columns="bidID,contractID,bidderID,dateBid,amount" key="bidID" name="bidList">
            <row amount="1000000.00" dateBid="2015-11-08 03:45:50" bidderID="92168909" contractID="98714177" bidID="4891368"/>
            <row amount="2000000.00" dateBid="2015-11-08 03:46:21" bidderID="95633963" contractID="98714177" bidID="4891412"/>
            <row amount="152441923.72" dateBid="2015-11-08 03:49:46" bidderID="1188435724" contractID="98714179" bidID="4891491"/>
        </rowset>
    </result>
</xml>
XML;
    }
}
