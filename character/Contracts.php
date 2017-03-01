<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 10:51
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\Contract;

class Contracts extends Request implements Simulatable
{
    public $url = '/char/Contracts.xml.aspx';
    public $contracts = [];

    public function parse($xml)
    {
        $bids = (new ContractBids($this->key))->bids;

        if (!empty($xml->rowset)) {
            foreach ($xml->rowset->row as $contract) {
                $this->contracts[] = new Contract(
                    $contract,
                    [
                        'contractID, issuerID, issuerCorpID, assigneeID, acceptorID, startStationID, endStationID, numDays' => 'int',
                        'dateIssued, dateExpired, dateAccepted, dateCompleted' => 'date',
                        'price, reward, collateral, buyout, volume' => 'float',
                        'type, status, title, availability' => 'str',
                        'forCorp' => 'bool'
                    ],
                    $bids[intval($contract['contractID'])],
                    new ContractKey(
                        $this->key->keyID,
                        $this->key->vCode,
                        $this->key->characterID,
                        intval($contract['contractID'])
                    )
                );
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
    <result>
        <rowset columns="contractID,issuerID,issuerCorpID,assigneeID,acceptorID,startStationID,endStationID,type,status,title,forCorp,availability,dateIssued,dateExpired,dateAccepted,numDays,dateCompleted,price,reward,collateral,buyout,volume" key="contractID" name="contractList">
            <row title="MWD Scimitar + Kin Hardener - Rigs in cargo" volume="89000" buyout="0.00" collateral="0.00" reward="0.00" price="220000000.00" dateCompleted="2015-10-16 04:36:30" numDays="0" dateAccepted="2015-10-16 04:36:30" dateExpired="2015-10-23 15:32:31" dateIssued="2015-10-09 15:32:31" availability="Private" forCorp="0" status="Completed" type="ItemExchange" endStationID="60015108" startStationID="60015108" acceptorID="258695360" assigneeID="386292982" issuerCorpID="673319797" issuerID="91512526" contractID="98714177"/>
            <row title="" volume="216000" buyout="0.00" collateral="0.00" reward="0.00" price="149000000.00" dateCompleted="2015-10-16 04:39:27" numDays="0" dateAccepted="2015-10-16 04:39:27" dateExpired="2015-10-26 03:31:21" dateIssued="2015-10-12 03:31:21" availability="Private" forCorp="0" status="Completed" type="ItemExchange" endStationID="60015108" startStationID="60015108" acceptorID="258695360" assigneeID="386292982" issuerCorpID="1941177176" issuerID="1524136743" contractID="98714179"/>
        </rowset>
    </result>
</xml>
XML;
    }
}
