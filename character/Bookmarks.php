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
                        $this->list[] = new BookmarkType([
                            'bookmarkID'    => intval($bookmark['bookmarkID']),
                            'creatorID'     => intval($bookmark['creatorID']),
                            'created'       => strval($bookmark['created']),
                            'itemID'        => intval($bookmark['itemID']),
                            'typeID'        => intval($bookmark['typeID']),
                            'locationID'    => intval($bookmark['locationID']),
                            'memo'          => strval($bookmark['memo']),
                            'note'          => strval($bookmark['note']),
                            'x'             => intval($bookmark['x']),
                            'y'             => intval($bookmark['y']),
                            'z'             => intval($bookmark['z'])
                        ], [
                            'created' => 'date'
                        ]);
                    }
                }
            }
        }

        if ($this->sorter) {
            $this->list = $this->sorter->sort($this->list);
        }
    }
}
