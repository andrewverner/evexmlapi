<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 18:59
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\MailMessage;

class MailMessages extends Request
{
    public $url = '/char/MailMessages.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            $ids = [];

            foreach ($xml->rowset->row as $message) {
                $messageID = intval($message['messageID']);
                $this->list[$messageID] = new MailMessage(
                    $message,
                    [
                        'sentDate' => 'date',
                        'messageID, senderID' => 'int',
                        'senderName, title, toCorpOrAllianceID, toCharacterIDs, toListID' => 'str'
                    ]
                );
                $ids[] = $messageID;
            }

            $bodies = new MailBodies(new MailBodiesKey(
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
}
