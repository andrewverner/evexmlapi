<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 15:44
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;

class AssetList extends Request
{
    public $url = '/char/AssetList.xml.aspx';
    public $list = [];
    private $sorter;

    public function __construct(Key $key, \Sorter $sorter = null)
    {
        $this->sorter = $sorter;
        parent::__construct($key);
    }

    public function parse($xml)
    {
        foreach ($xml->rowset->row as $asset) {
            $type = new \AssetType([
                'itemID'        => intval($asset['itemID']),
                'locationID'    => intval($asset['locationID']),
                'typeID'        => intval($asset['typeID']),
                'quantity'      => intval($asset['quantity']),
                'flag'          => intval($asset['flag']),
                'singleton'     => boolval($asset['singleton']),
                'rawQuantity'   => intval($asset['rawQuantity'])
            ]);

            if (isset($asset->rowset)) {
                $type->nested = [];
                foreach ($asset->rowset->row as $nested) {
                    $type->nested[] = new \AssetType([
                        'itemID'        => intval($nested['itemID']),
                        'locationID'    => intval($nested['locationID']),
                        'typeID'        => intval($nested['typeID']),
                        'quantity'      => intval($nested['quantity']),
                        'flag'          => intval($nested['flag']),
                        'singleton'     => boolval($nested['singleton']),
                        'rawQuantity'   => intval($nested['rawQuantity'])
                    ]);
                }
            }

            $this->list[] = $type;
        }

        if ($this->sorter) {
            $this->list = $this->sorter->sort($this->list);
        }
    }
}
