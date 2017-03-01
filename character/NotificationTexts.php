<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:51
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;

class NotificationTexts extends Request implements Simulatable
{
    public $url = '/char/NotificationTexts.xml.aspx';
    public $list;
    public $ids;

    public function __construct(MailBodiesKey $key)
    {
        parent::__construct($key);
    }

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $message) {
                $this->list[intval($message['notificationID'])] = strval($message);
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
<rowset name="notifications" key="notificationID" columns="notificationID">
    <row notificationID="399058967"><![CDATA[
        isHouseWarmingGift: 1
        shipTypeID: 606
    ]]></row>
    <row notificationID="399058968"><![CDATA[
        amount: 25000000
        dueDate: 129808158000000000
    ]]></row>
    <row notificationID="374106507"><![CDATA[
         againstID: 673381830
         cost: null
         declaredByID: 98105019
         delayHours: null
         hostileState: null
    ]]></row>
    <row notificationID="399058969"><![CDATA[
          aggressorAllianceID: 673381830
          aggressorCorpID: 785714366
          aggressorID: 1746208390
          armorValue: 1.0
          hullValue: 1.0
          moonID: 40264916
          shieldValue: 0.995
          solarSystemID: 30004181
          typeID: 16688
    ]]></row>
</rowset>
</result>
</xml>
XML;
    }
}
