<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 02.03.17
 * Time: 0:04
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\AssetType;

class AssetList extends Request implements Simulatable
{
    public $url = '/corp/AssetList.xml.aspx';
    public $list;
    private $sorter;

    public function __construct(Key $key, \Sorter $sorter = null)
    {
        $this->sorter = $sorter;
        parent::__construct($key);
    }

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];

            foreach ($xml->rowset->row as $asset) {
                $this->list[] = new AssetType(
                    $asset,
                    ['itemID, locationID, typeID, quantity, singleton, flag' => 'int']
                );
            }

            if ($this->sorter) {
                $this->list = $this->sorter->sort($this->list);
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset name="assets" key="itemID" columns="itemID,locationID,typeID,quantity,flag,singleton">
        <row itemID="1787288209" locationID="60003760" typeID="12743" quantity="1" flag="4" singleton="1" rawQuantity="-1" />
        <row itemID="1018046062102" locationID="60003760" typeID="16247" quantity="17" flag="4" singleton="0" />
        <row itemID="1018482760487" locationID="60003760" typeID="24595" quantity="51207" flag="4" singleton="0" />
        <row itemID="1018510338105" locationID="60003761" typeID="24593" quantity="62656" flag="4" singleton="0" />
        <row itemID="1018511379483" locationID="60003761" typeID="19689" quantity="19" flag="4" singleton="0" />
        <row itemID="1018526577354" locationID="60003760" typeID="21918" quantity="348589" flag="4" singleton="0" />
    </rowset>
</result>
</xml>
XML;
    }
}
