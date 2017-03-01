<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:41
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\Medal;

class Medals extends Request implements Simulatable
{
    public $url = '/char/Medals.xml.aspx';
    public $currentCorporation;
    public $otherCorporations;

    public function parse($xml)
    {
        foreach ($xml->rowset as $rowset) {
            if (!empty($rowset)) {
                $group = strval($rowset['name']);
                $this->{$group} = [];
                foreach ($rowset->row as $medal) {
                    $this->{$group}[] = new Medal(
                        $medal,
                        [
                            'medalID, issuerID, corporationID' => 'int',
                            'reason, status, title, description' => 'str',
                            'issued' => 'date'
                        ]
                    );
                }
            }

        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset name="currentCorporation" key="medalID" columns="medalID,reason,status,issuerID,issued">
        <row medalID="95079" reason="For continued support, loyalty and dedication towards" status="public" issuerID="259695227" issued="2012-11-19 08:21:17"/>
    </rowset>
    <rowset name="otherCorporations" key="medalID" columns="medalID,reason,status,issuerID,issued,corporationID,title,description">
        <row medalID="4106" reason="For continued support, loyalty and dedication towards the Centre for Advanced Studies" status="private" issuerID="132533870" issued="2008-11-25 10:36:01" corporationID="1711141370" title="Medal of Service" description="For taking initiative and making an extraordinary contribution towards the corporation"/>
    </rowset>
</result>
</xml>
XML;
    }
}
