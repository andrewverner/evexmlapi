<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 16:48
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Types\BlueprintType;

class Blueprints extends Request
{
    public $url = '/char/Blueprints.xml.aspx';
    public $list = [];
    private $sorter;

    public function __construct(Key $key = null, \Sorter $sorter = null)
    {
        $this->sorter = $sorter;
        parent::__construct($key);
    }

    function parse($xml)
    {
        if (!empty($xml->rowset)) {
            foreach ($xml->rowset->row as $blueprint) {
                $this->list[] = new BlueprintType([
                    'runs'                  => intval($blueprint['$runs']),
                    'materialEfficiency'    => intval($blueprint['materialEfficiency']),
                    'timeEfficiency'        => intval($blueprint['timeEfficiency']),
                    'quantity'              => intval($blueprint['quantity']),
                    'flagID'                => intval($blueprint['flagID']),
                    'typeName'              => strval($blueprint['typeName']),
                    'typeID'                => intval($blueprint['typeID']),
                    'locationID'            => intval($blueprint['locationID']),
                    'itemID'                => intval($blueprint['itemID'])
                ]);
            }
        }

        if ($this->sorter) {
            $this->list = $this->sorter->sort($this->list);
        }
    }
}
