<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:26
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\Skill;

class Skills extends Request
{
    public $url = '/char/Skills.xml.aspx';
    public $list = [];

    public function parse($xml)
    {
        foreach ($xml->rowset->row as $skill) {
            $this->list[] = new Skill(
                $skill,
                [
                    'typeName' => 'str',
                    'typeID, skillpoints, level, published' => 'int'
                ]
            );
        }
    }
}
