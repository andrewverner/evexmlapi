<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 20:15
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;

class SkillInTraining extends Request
{
    public $url = '/char/SkillInTraining.xml.aspx';
    public $currentTQTime;
    public $trainingEndTime;
    public $trainingStartTime;
    public $trainingTypeID;
    public $trainingStartSP;
    public $trainingDestinationSP;
    public $trainingToLevel;
    public $skillInTraining;

    public function parse($xml)
    {
        if ($xml) {
            $this->currentTQTime = new \DateTime($xml->currentTQTime);
            $this->trainingEndTime = new \DateTime($xml->trainingEndTime);
            $this->trainingStartTime = new \DateTime($xml->trainingStartTime);
            $this->trainingTypeID = intval($xml->trainingTypeID);
            $this->trainingStartSP = intval($xml->trainingStartSP);
            $this->trainingDestinationSP = intval($xml->trainingDestinationSP);
            $this->trainingToLevel = intval($xml->trainingToLevel);
            $this->skillInTraining = intval($xml->skillInTraining);
        }
    }
}
