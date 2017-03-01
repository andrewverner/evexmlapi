<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 19:50
 */

namespace EveXMLAPI\types;

/**
 * Class Notification
 * @package EveXMLAPI\types
 *
 * @property $notificationID
 * @property $typeID
 * @property $senderID
 * @property $senderName
 * @property $sentDate
 * @property $read
  */
class Notification extends Type
{
    public $text;
}
