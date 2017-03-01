<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 13:31
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\IndustryJob;

class IndustryJobsHistory extends Request implements Simulatable
{
    public $url = '/char/IndustryJobsHistory.xml.aspx';
    public $list;

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $job) {
                $this->list[] = new IndustryJob(
                    $job,
                    [
                        'jobID, installerID, facilityID, solarSystemID, stationID, activityID, blueprintID' => 'int',
                        'blueprintLocationID, outputLocationID, runs, teamID, licensedRuns, productTypeID' => 'int',
                        'status, timeInSeconds, completedCharacterID, successfulRuns, productTypeName' => 'int',
                        'installerName, solarSystemName, blueprintTypeName' => 'str',
                        'cost, probability' => 'float',
                        'startDate, endDate, pauseDate, completedDate' => 'date'
                    ]
                );
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<xml>
<result>
    <rowset name="jobs" key="jobID" columns="jobID,installerID,installerName,facilityID,solarSystemID,solarSystemName,stationID,activityID,blueprintID,blueprintTypeID,blueprintTypeName,blueprintLocationID,outputLocationID,runs,cost,teamID,licensedRuns,probability,productTypeID,productTypeName,status,timeInSeconds,startDate,endDate,pauseDate,completedDate,completedCharacterID,successfulRuns">
        <row jobID="229136101" installerID="498338451" installerName="Qoi" facilityID="60006382" solarSystemID="30005194" 
             solarSystemName="Cleyd" stationID="60006382" activityID="1" blueprintID="1015116533326"
             blueprintTypeID="2047" blueprintTypeName="Damage Control I Blueprint" blueprintLocationID="60006382" 
             outputLocationID="60006382" runs="1" cost="118.00" teamID="0" licensedRuns="200" probability="0"
             productTypeID="0" productTypeName="" status="1" timeInSeconds="548"
             startDate="2014-07-19 15:47:06" endDate="2014-07-19 15:56:14" pauseDate="0001-01-01 00:00:00"
             completedDate="0001-01-01 00:00:00" completedCharacterID="0" successfulRuns="1"/>
        <row jobID="229135883" installerID="498338451" installerName="Qoi" facilityID="60006382" solarSystemID="30005194"
             solarSystemName="Cleyd" stationID="60006382" activityID="3" blueprintID="1015321999447" 
             blueprintTypeID="25862" blueprintTypeName="Salvager I Blueprint" blueprintLocationID="60006382" 
             outputLocationID="60006382" runs="1" cost="29.00" teamID="0" licensedRuns="60" probability="0" 
             productTypeID="0" productTypeName="" status="1" timeInSeconds="702" 
             startDate="2014-07-19 13:40:59" endDate="2014-07-19 13:52:41" pauseDate="0001-01-01 00:00:00" 
             completedDate="0001-01-01 00:00:00" completedCharacterID="0" successfulRuns="2"/>
        <row jobID="229135882" installerID="498338451" installerName="Qoi" facilityID="60006382" solarSystemID="30005194" 
             solarSystemName="Cleyd" stationID="60006382" activityID="4" blueprintID="1015322244720" 
             blueprintTypeID="785" blueprintTypeName="Miner I Blueprint" blueprintLocationID="60006382" 
             outputLocationID="60006382" runs="1" cost="8.00" teamID="0" licensedRuns="200" probability="0" 
             productTypeID="0" productTypeName="" status="1" timeInSeconds="225" 
             startDate="2014-07-19 13:40:32" endDate="2014-07-19 13:44:17" pauseDate="0001-01-01 00:00:00" 
             completedDate="0001-01-01 00:00:00" completedCharacterID="0" successfulRuns="3"/>
        <row jobID="229135868" installerID="498338451" installerName="Qoi" facilityID="60006382" solarSystemID="30005194" 
             solarSystemName="Cleyd" stationID="60006382" activityID="5" blueprintID="1015322013688" blueprintTypeID="10040" 
             blueprintTypeName="Civilian Shield Booster Blueprint" blueprintLocationID="60006382" 
             outputLocationID="60006382" runs="23" cost="2768.00" teamID="0" licensedRuns="99" probability="0" 
             productTypeID="0" productTypeName="" status="1" timeInSeconds="389367" 
             startDate="2014-07-19 13:22:51" endDate="2014-07-24 01:32:18" pauseDate="0001-01-01 00:00:00" 
             completedDate="0001-01-01 00:00:00" completedCharacterID="0" successfulRuns="4"/>
        <row jobID="229136102" installerID="498338451" installerName="Qoi" facilityID="1015338129652" solarSystemID="30005195"
             solarSystemName="Vecamia" stationID="1015338119317" activityID="7" blueprintID="1015338143203" blueprintTypeID="30614"
             blueprintTypeName="Intact Armor Nanobot" blueprintLocationID="1015338129652"
             outputLocationID="1015338129652" runs="1" cost="641.00" teamID="0" licensedRuns="300" probability="0"
             productTypeID="0" productTypeName="" status="1" timeInSeconds="3600"
             startDate="2014-07-19 15:48:33" endDate="2014-07-19 16:48:33" pauseDate="0001-01-01 00:00:00"
             completedDate="0001-01-01 00:00:00" completedCharacterID="0" successfulRuns="5"/>
        <row jobID="229136071" installerID="498338451" installerName="Qoi" facilityID="1015338129650" solarSystemID="30005195" 
             solarSystemName="Vecamia" stationID="1015338119317" activityID="8" blueprintID="1015338137468" blueprintTypeID="1137" 
             blueprintTypeName="Antimatter Charge S Blueprint" blueprintLocationID="1015338129650"
             outputLocationID="1015338129650" runs="1" cost="4.00" teamID="0" licensedRuns="600" probability="0" 
             productTypeID="0" productTypeName="" status="1" timeInSeconds="11400" 
             startDate="2014-07-19 15:22:40" endDate="2014-07-19 18:32:40" pauseDate="0001-01-01 00:00:00" 
             completedDate="0001-01-01 00:00:00" completedCharacterID="0" successfulRuns="6"/>
    </rowset>
</result>
</xml>
XML;

    }
}
