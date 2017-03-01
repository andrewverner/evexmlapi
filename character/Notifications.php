<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:53
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\types\Notification;

class Notifications extends Request implements Simulatable
{
    public $url = '/char/Notifications.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            $ids = [];

            foreach ($xml->rowset->row as $message) {
                $messageID = intval($message['notificationID']);
                $this->list[$messageID] = new Notification(
                    $message,
                    [
                        'sentDate' => 'date',
                        'notificationID, senderID, typeID' => 'int',
                        'senderName' => 'str',
                        'read' => 'bool'
                    ]
                );
                $ids[] = $messageID;
            }

            $bodies = new NotificationTexts(new MailBodiesKey(
                $this->key->keyID,
                $this->key->vCode,
                $this->key->characterID,
                $ids
            ));

            foreach ($this->list as $id => $message) {
                if (isset($bodies->list[$id])) {
                    $message->text = $bodies->list[$id];
                }
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
  <rowset name="notifications" key="notificationID" columns="notificationID,typeID,senderID,senderName,sentDate,read">
    <row notificationID="399058967" typeID="73" senderID="3017794" senderName="Some guy" sentDate="2012-12-22 23:34:00" read="0" />
    <row notificationID="399058968" typeID="73" senderID="3017794" senderName="Some guy" sentDate="2012-12-22 23:34:00" read="0" />
    <row notificationID="399058969" typeID="73" senderID="3017794" senderName="Some guy" sentDate="2012-12-22 23:34:00" read="0" />
  </rowset>
</result>
</xml>
XML;
    }
}
