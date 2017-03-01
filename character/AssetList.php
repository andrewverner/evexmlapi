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
use EveXMLAPI\Types\AssetType;

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
            $type = new AssetType(
                $asset,
                ['itemID, locationID, typeID, quantity, flag, singleton, rawQuantity' => 'int']
            );

            if (isset($asset->rowset)) {
                $type->nested = [];
                foreach ($asset->rowset->row as $nested) {
                    $type->nested[] = new AssetType(
                        $nested,
                        ['itemID, locationID, typeID, quantity, flag, singleton, rawQuantity' => 'int']
                    );
                }
            }

            $this->list[] = $type;
        }

        if ($this->sorter) {
            $this->list = $this->sorter->sort($this->list);
        }
    }
}
