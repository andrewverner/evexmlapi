<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 02.03.17
 * Time: 0:25
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\ContainerLogType;

class ContainerLog extends Request
{
    public $url = '/corp/ContainerLog.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $log) {
                $this->list[] = new ContainerLogType(
                    $log,
                    [
                        'logTime' => 'date',
                        'itemID, itemTypeID, actorID, locationID, typeID, quantity' => 'int',
                        'actorName, flag, action, passwordType, oldConfiguration, newConfiguration' => 'str'
                    ]
                );
            }
        }
    }
}
