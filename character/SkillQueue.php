<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:19
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\QueuedSkill;

class SkillQueue extends Request
{
    public $url = '/char/SkillQueue.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $skill) {
                $this->list[intval($skill['queuePosition'])] = new QueuedSkill(
                    $skill,
                    [
                        'startTime, endTime' => 'date',
                        'queuePosition, typeID, level, startSP, endSP' => 'int'
                    ]
                );
            }
        }
    }
}
