<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 0:14
 */

namespace EveXMLAPI\Types;

class ChatChannel
{
    public $channelID;
    public $ownerID;
    public $ownerName;
    public $displayName;
    public $comparisonKey;
    public $hasPassword;
    public $motd;

    public $allowed = [];
    public $blocked = [];
    public $muted = [];
    public $operators = [];

    public function __construct($row)
    {
        $this->channelID        = intval($row['channelID']);
        $this->ownerID          = intval($row['ownerID']);
        $this->ownerName        = strval($row['ownerName']);
        $this->displayName      = strval($row['displayName']);
        $this->comparisonKey    = strval($row['comparisonKey']);
        $this->hasPassword      = (strval($row['hasPassword']) == 'True');
        $this->motd             = strval($row['motd']);

        foreach ($row->rowset as $rowset) {
            switch ($rowset['name']) {
                case 'allowed':
                case 'operators':
                    foreach ($rowset->row as $accessor) {
                        $this->{$rowset['name']}[] = new AccessorType([
                            'accessorID'    => intval($accessor['accessorID']),
                            'accessorName'  => strval($accessor['accessorName'])
                        ]);
                    }
                    break;

                case 'blocked':
                case 'muted':
                    foreach ($rowset->row as $accessor) {
                        $this->{$rowset['name']}[] = new AccessorType([
                            'accessorID'    => intval($accessor['accessorID']),
                            'accessorName'  => strval($accessor['accessorName']),
                            'untilWhen'     => strval($accessor['untilWhen']),
                            'reason'        => strval($accessor['reason'])
                        ], [
                            'untilWhen' => 'date'
                        ]);
                    }
                    break;

                default:
                    break;
            }
        }
    }
}
