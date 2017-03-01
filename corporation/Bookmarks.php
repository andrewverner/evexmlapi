<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 17:18
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\BookmarkType;

class Bookmarks extends Request implements Simulatable
{
    public $url = '/corp/Bookmarks.xml.aspx';
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
            foreach ($xml->rowset->row as $folder) {
                if (!empty($folder->rowset)) {
                    foreach ($folder->rowset->row as $bookmark) {
                        $this->list[] = new BookmarkType(
                            $bookmark,
                            [
                                'bookmarkID, creatorID, itemID, typeID, locationID, x, y, z' => 'int',
                                'created' => 'date',
                                'memo, note' => 'str'
                            ]
                        );
                    }
                }
            }
        }

        if ($this->sorter) {
            $this->list = $this->sorter->sort($this->list);
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset name="folders" key="folderID" columns="folderID,folderName,creatorID">
        <row folderID="0" folderName="" creatorID="0">
            <rowset name="bookmarks" key="bookmarkID" columns="bookmarkID,creatorID,created,itemID,typeID,locationID,x,y,z,memo,note">
                <row bookmarkID="12" creatorID="90000001" created="2015-07-08 21:34:14" itemID="60014689" typeID="57" locationID="30004971" x="0" y="0" z="0" memo="Home Station" note="Our base of residence" />
                <row bookmarkID="13" creatorID="90000001" created="2015-07-08 21:35:07" itemID="40314792" typeID="8" locationID="30004971" x="0" y="0" z="0" memo="Sun" note="" />
            </rowset>
        </row>
        <row folderID="1" folderName="A lovely empty folder" creatorID="90000001">
            <rowset name="bookmarks" key="bookmarkID" columns="bookmarkID,creatorID,created,itemID,typeID,locationID,x,y,z,memo,note" />
        </row>
        <row folderID="3" folderName="Sites" creatorID="90000001">
            <rowset name="bookmarks" key="bookmarkID" columns="bookmarkID,creatorID,created,itemID,typeID,locationID,x,y,z,memo,note">
                <row bookmarkID="16" creatorID="90000001" created="2015-07-08 21:37:12" itemID="40314827" typeID="15" locationID="30004971" x="0" y="0" z="0" memo="Duripant VII - Asteroid Belt 2 ( Asteroid Belt )" note="" />
                <row bookmarkID="17" creatorID="90000001" created="2015-07-08 21:37:22" itemID="40314829" typeID="15" locationID="30004972" x="0" y="0" z="0" memo="Duripant VII - Asteroid Belt 3 ( Asteroid Belt )" note="" />
                <row bookmarkID="18" creatorID="90000001" created="2015-07-08 21:37:29" itemID="40314794" typeID="15" locationID="30004972" x="0" y="0" z="0" memo="Duripant I - Asteroid Belt 1 ( Asteroid Belt )" note="" />
                <row bookmarkID="19" creatorID="90000001" created="2015-07-08 21:37:39" itemID="40314811" typeID="15" locationID="30004971" x="0" y="0" z="0" memo="Duripant VII - Asteroid Belt 1 ( Asteroid Belt )" note="" />
            </rowset>
        </row>
        <row folderID="4" folderName="Random crap" creatorID="90000001">
            <rowset name="bookmarks" key="bookmarkID" columns="bookmarkID,creatorID,created,itemID,typeID,locationID,x,y,z,memo,note">
                <row bookmarkID="14" creatorID="90000001" created="2015-07-08 21:36:08" itemID="0" typeID="5" locationID="30004973" x="-373405654941.733" y="42718621667.0746" z="-1415023302173.46" memo="spot in Duripant solar system" note="" />
                <row bookmarkID="15" creatorID="90000001" created="2015-07-08 21:36:46" itemID="0" typeID="5" locationID="30004971" x="-373405652840.03" y="42718623812.4957" z="-1415023308332.07" memo="spot in Duripant solar system" note="" />
            </rowset>
        </row>
    </rowset>
</result>
</xml>
XML;
    }
}
