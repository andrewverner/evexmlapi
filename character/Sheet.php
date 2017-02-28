<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 28.02.17
 * Time: 20:40
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Types\SkillType;
use EveXMLAPI\Types\Type;

/**
 * Class Sheet
 * @package EveXMLAPI\Character
 *
 * @property $characterID
 * @property $name
 * @property $homeStationID
 * @property $DoB
 * @property $race
 * @property $bloodLineID
 * @property $bloodLine
 * @property $ancestryID
 * @property $ancestry
 * @property $gender
 * @property $corporationName
 * @property $corporationID
 * @property $allianceName
 * @property $allianceID
 * @property $cloneTypeID
 * @property $cloneName
 * @property $cloneSkillPoints
 * @property $freeSkillPoints
 * @property $freeRespecs
 * @property $cloneJumpDate
 * @property $lastRespecDate
 * @property $lastTimedRespec
 * @property $remoteStationDate
 * @property $jumpClones
 * @property $jumpActivation
 * @property $jumpFatigue
 * @property $jumpLastUpdate
 * @property $balance
 * @property $implants
 * @property $attributes
 * @property $skills
 * @property $certificates
 * @property $corporationRoles
 * @property $corporationRolesAtHQ
 * @property $corporationRolesAtBase
 * @property $corporationRolesAtOther
 * @property $corporationTitles
 */
class Sheet extends Request
{
    public $url = '/char/CharacterSheet.xml.aspx';

    public function parse($xml)
    {
        $this->name = strval($xml->name);
        $this->homeStationID        = intval($xml->homeStationID);
        $this->DoB                  = new \DateTime(strval($xml->DoB));
        $this->race                 = strval($xml->race);
        $this->bloodLineID          = intval($xml->bloodLineID);
        $this->bloodLine            = strval($xml->bloodLine);
        $this->ancestryID           = intval($xml->ancestryID);
        $this->ancestry             = strval($xml->ancestry);
        $this->gender               = strval($xml->gender);
        $this->corporationName      = strval($xml->corporationName);
        $this->corporationID        = intval($xml->corporationID);
        $this->allianceName         = strval($xml->allianceName);
        $this->allianceID           = intval($xml->allianceID);
        $this->freeSkillPoints      = intval($xml->freeSkillPoints);
        $this->freeRespecs          = intval($xml->freeRespecs);
        $this->cloneJumpDate        = new \DateTime(strval($xml->cloneJumpDate));
        $this->lastRespecDate       = new \DateTime(strval($xml->lastRespecDate));
        $this->lastTimedRespec      = new \DateTime(strval($xml->lastTimedRespec));
        $this->remoteStationDate    = new \DateTime(strval($xml->remoteStationDate));
        $this->jumpActivation       = new \DateTime(strval($xml->jumpActivation));
        $this->jumpFatigue          = new \DateTime(strval($xml->jumpFatigue));
        $this->jumpLastUpdate       = new \DateTime(strval($xml->jumpLastUpdate));
        $this->balance              = floatval($xml->balance);
        $this->attributes           = new \stdClass();
        $this->attributes->intelligence = intval($xml->attributes->intelligence);
        $this->attributes->memory       = intval($xml->attributes->memory);
        $this->attributes->charisma     = intval($xml->attributes->charisma);
        $this->attributes->perception   = intval($xml->attributes->perception);
        $this->attributes->willpower    = intval($xml->attributes->willpower);

        foreach ($xml->rowset as $rowset) {
            if (!empty($rowset)) {
                switch ($rowset['name']) {
                    case 'jumpClones':
                        /**
                         * @todo
                         */
                        break;

                    case 'implants':
                        $this->implants = [];
                        foreach ($rowset->row as $implant) {
                            $this->implants[] = new Type([
                                'typeID'    => intval($implant['typeID']),
                                'name'      => strval($implant['name'])
                            ]);
                        }
                        break;

                    case 'skills':
                        $this->skills = [];
                        foreach ($rowset->row as $skill) {
                            $this->skills[] = new SkillType([
                                'typeID'        => intval($skill['typeID']),
                                'published'     => intval($skill['published']),
                                'level'         => intval($skill['level']),
                                'skillpoints'   => intval($skill['skillpoints']),
                            ]);
                        }
                        break;

                    case 'corporationRoles':
                    case 'corporationRolesAtHQ':
                    case 'corporationRolesAtBase':
                    case 'corporationRolesAtOther':
                        $this->{$rowset['name']} = [];
                        foreach ($rowset->row as $role) {
                            $this->{$rowset['name']}[] = new Type([
                                'roleID' => intval($role['roleID']),
                                'roleName' => strval($role['roleName'])
                            ]);
                        }
                        break;

                    case 'corporationTitles':
                        $this->corporationTitles = [];
                        foreach ($rowset->row as $title) {
                            $this->corporationTitles[] = new Type([
                                'titleID' => intval($title['titleID']),
                                'titleName' => strval($title['titleName'])
                            ]);
                        }
                        break;

                    default:
                        break;
                }
            }
        }
    }
}
