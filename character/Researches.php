<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:10
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\Research;

class Researches extends Request implements Simulatable
{
    public $url = '/char/Research.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $research) {
                $this->list[] = new Research(
                    $research,
                    [
                        'researchStartDate' => 'date',
                        'agentID, skillTypeID' => 'int',
                        'pointsPerDay, remainderPoints' => 'float'
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
    <rowset name="research" key="agentID" columns="agentID,skillTypeID,researchStartDate,pointsPerDay,remainderPoints">
        <row agentID="3009358" skillTypeID="11450" researchStartDate="2014-11-27 16:34:47" pointsPerDay="53.5346162146776" remainderPoints="53604.0634303189"/>
        <row agentID="3012617" skillTypeID="11453" researchStartDate="2015-01-31 21:31:02" pointsPerDay="37.0312810778599" remainderPoints="65.140031465693"/>
        <row agentID="3012662" skillTypeID="11452" researchStartDate="2015-01-31 05:38:13" pointsPerDay="53.3700894238397" remainderPoints="23.557288895885"/>
        <row agentID="3013460" skillTypeID="11449" researchStartDate="2015-01-31 21:11:04" pointsPerDay="5.8" remainderPoints="0"/>
    </rowset>
</result>
</xml>
XML;
    }
}
