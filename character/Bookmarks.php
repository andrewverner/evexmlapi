<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 17:18
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Types\BookmarkType;

class Bookmarks extends Request
{
    public $url = '/char/Bookmarks.xml.aspx';
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
}
