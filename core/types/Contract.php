<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 10:53
 */

namespace EveXMLAPI\Types;

use EveXMLAPI\Character\ContractItems;
use EveXMLAPI\Character\ContractKey;

class Contract extends Type
{
    public $contractID;
    public $issuerID;
    public $issuerCorpID;
    public $assigneeID;
    public $acceptorID;
    public $startStationID;
    public $endStationID;
    public $type;
    public $status;
    public $title;
    public $forCorp;
    public $availability;
    public $dateIssued;
    public $dateExpired;
    public $dateAccepted;
    public $numDays;
    public $dateCompleted;
    public $price;
    public $reward;
    public $collateral;
    public $buyout;
    public $volume;

    public $bids;
    public $items;

    public function __construct($data, array $behaviour = [], array $bids, ContractKey $contractKey)
    {
        parent::__construct($data, $behaviour);
        $this->bids = $bids;
        $this->items = (new ContractItems($contractKey))->list;
    }
}
